<?php

namespace TheFramework\App;

use Exception;

/**
 * @mixin QueryBuilder
 */
class Relation
{
    public $query;
    public $parent;
    public ?Model $related;
    public $type;
    public $foreignKey;
    public $localKey;
    public $pivotTable;
    public $relatedKey;
    public $morphType;
    public $select = [];
    public $additionalPivotColumns = [];
    protected $partitionLimit = null;

    public function __construct($type, Model $parent, ?Model $related, $foreignKey, $localKey = null, $pivotTable = null, $relatedKey = null, $additionalPivotColumns = [])
    {
        $this->type = $type;
        $this->parent = $parent;
        $this->related = $related;
        $this->foreignKey = $foreignKey;
        $this->localKey = $localKey;
        $this->pivotTable = $pivotTable;
        $this->relatedKey = $relatedKey;
        $this->additionalPivotColumns = $additionalPivotColumns;

        if ($this->related) {
            $this->query = $this->related->query();
        }

        // Removed the conditional call to addConstraints() from here.
        // It will now be called explicitly in getResults() for lazy loading,
        // and addEagerConstraints() for eager loading.
    }

    public function ofEach(int $count): self
    {
        if ($count < 1) {
            throw new \InvalidArgumentException("Jumlah untuk ofEach() harus lebih besar dari 0.");
        }
        $this->partitionLimit = $count;
        return $this;
    }

    public function getPartitionLimit(): ?int
    {
        return $this->partitionLimit;
    }

    public function getForeignKeyName(): string
    {
        if ($this->type === 'morphMany') {
            return $this->foreignKey;
        }
        return $this->related ? $this->related->getTable() . '.' . $this->foreignKey : $this->foreignKey;
    }

    public function getLocalKeyName(): string
    {
        return $this->localKey;
    }

    public function getQualifiedForeignKeyName()
    {
        return $this->parent->getTable() . '.' . $this->foreignKey;
    }
    public function getRelated(): ?Model
    {
        return $this->related;
    }
    public function getMorphType()
    {
        return $this->localKey;
    }
    public function isMorphTo()
    {
        return $this->type === 'morphTo';
    }

    // Renamed from addConstraints() to addLazyConstraints()
    public function addLazyConstraints()
    {
        if ($this->type === 'hasMany' || $this->type === 'hasOne') {
            $this->query->where($this->foreignKey, '=', $this->parent->getAttribute($this->localKey));
        } elseif ($this->type === 'belongsTo') {
            $this->query->where($this->relatedKey, '=', $this->parent->getAttribute($this->foreignKey));
        }
    }

    public function addEagerConstraints(array $models)
    {
        if ($this->type === 'belongsTo') {

            $keys = array_unique(array_filter(array_map(function ($model) {
                return $model->{$this->foreignKey};
            }, $models)));

            // DEBUG BARU: Log keys yang akan digunakan dalam query whereIn
            error_log("DEBUG EAGER: Kunci untuk belongsTo '{$this->foreignKey}' di query whereIn: " . implode(', ', $keys));

            if (empty($keys)) return;

            $this->query->whereIn($this->relatedKey, $keys);
            return;
        }

        if ($this->type === 'hasMany') {

            $keys = array_unique(array_map(function ($model) {
                return $model->{$this->localKey};
            }, $models));

            $this->query->whereIn($this->foreignKey, $keys);
        }
    }

    public function match(array $models, array $results, $relation)
    {
        if ($this->type === 'belongsTo') {
            // DEBUG: Log informasi relasi yang sedang diproses
            error_log("DEBUG RELASI: Memuat relasi '{$relation}' (belongsTo). foreignKey: {$this->foreignKey}, relatedKey: {$this->relatedKey}");

            // Buat dictionary: users.uid => userModel
            $dictionary = [];

            foreach ($results as $result) {
                $key = $result->{$this->relatedKey};
                $dictionary[$key] = $result;
                // DEBUG: Log UID dari model yang dimasukkan ke dictionary
                // error_log("DEBUG DICT: Menambahkan ke dictionary. Kunci: {$key}, Model: " . get_class($result));
            }

            // Attach ke parent
            foreach ($models as $model) {
                $foreignValue = $model->{$this->foreignKey};
                // DEBUG: Log foreignValue (uid_user dari registration)
                // error_log("DEBUG ATTACH: Mencocokkan model " . get_class($model) . " dengan foreignKey '{$foreignValue}'");

                $matchedRelation = $dictionary[$foreignValue] ?? null;

                // DEBUG: Log hasil pencocokan
                if (is_null($matchedRelation)) {
                    // error_log("DEBUG ATTACH: TIDAK DITEMUKAN untuk foreignKey '{$foreignValue}'");
                } else {
                    // error_log("DEBUG ATTACH: DITEMUKAN untuk foreignKey '{$foreignValue}' (Model: " . get_class($matchedRelation) . ")");
                }

                $model->setRelation(
                    $relation,
                    $matchedRelation
                );
            }

            return $models;
        }

        // === HAS MANY ===
        if ($this->type === 'hasMany') {

            $dictionary = [];

            foreach ($results as $result) {
                $dictionary[$result->{$this->foreignKey}][] = $result;
            }

            foreach ($models as $model) {

                $localValue = $model->{$this->localKey};

                $model->setRelation(
                    $relation,
                    $dictionary[$localValue] ?? []
                );
            }

            return $models;
        }

        return $models;
    }

    protected function buildDictionary(array $results)
    {
        $dictionary = [];
        $keyName = ($this->type === 'hasMany' || $this->type === 'hasOne' || $this->type === 'morphMany') ? $this->foreignKey : $this->relatedKey;

        foreach ($results as $result) {
            $key = $result->getAttribute($keyName);
            if ($key !== null) {
                $dictionary[$key][] = $result;
            }
        }
        return $dictionary;
    }

    protected function getKeys(array $models, $keyName)
    {
        $keys = [];
        foreach ($models as $model) {
            $val = $model->getAttribute($keyName);
            if ($val !== null) {
                $keys[] = $val;
            }
        }
        return array_unique($keys);
    }

    public function getResults()
    {
        if ($this->isMorphTo()) {
            $type = $this->parent->{$this->localKey};
            $id = $this->parent->{$this->foreignKey};
            if (!$type || !$id) return null;
            return (new $type)->find($id);
        }

        if ($this->type === 'hasOne' || $this->type === 'belongsTo') {
            // Explicitly call addLazyConstraints() here for lazy loading
            $this->addLazyConstraints();
            return $this->first();
        }
        return $this->get();
    }

    public function create(array $attributes = [])
    {
        if (!$this->related) throw new Exception("Cannot create on a polymorphic relationship.");

        if ($this->type === 'hasMany' || $this->type === 'hasOne') {
            $attributes[$this->foreignKey] = $this->parent->getAttribute($this->localKey);
        } elseif ($this->type === 'morphMany') {
            $attributes[$this->foreignKey] = $this->parent->getKey();
            $attributes[$this->relatedKey] = get_class($this->parent);
        }
        return $this->related->create($attributes);
    }

    public function __call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return $this->$method(...$parameters);
        }

        if (is_null($this->query)) {
            throw new Exception('Query is not available for this relation type.');
        }

        $result = $this->query->$method(...$parameters);

        if ($result === $this->query) {
            return $this;
        }

        return $result;
    }
}
