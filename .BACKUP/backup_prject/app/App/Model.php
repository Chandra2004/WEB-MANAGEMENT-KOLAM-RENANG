<?php

namespace TheFramework\App;

use ReflectionClass;
use Exception;
use ArrayAccess;
use Closure;

/**
 * @method static \TheFramework\App\QueryBuilder query()
 * @method static array all()
 * @method static mixed find($id)
 * @method static mixed findOrFail($id)
 * @method static static with(array $relations)
 * @method static static withCount(array $relations)
 * @method static \TheFramework\App\QueryBuilder where($column, $operator = null, $value = null, $boolean = 'AND')
 * @method static \TheFramework\App\QueryBuilder whereHas(string $relation, Closure $callback = null)
 * @method static \TheFramework\App\QueryBuilder latest(string $column = 'created_at')
 * @method static \TheFramework\App\QueryBuilder oldest(string $column = 'created_at')
 * @method static int count()
 * @method static array paginate(int $perPage = 15, int $page = 1)
 * @method static mixed create(array $data)
 * @method static int update(array $data)
 * @method static int delete($id = null)
 * @method static mixed firstOrCreate(array $attributes, array $values = [])
 * @method static mixed updateOrCreate(array $attributes, array $values)
 * @method static int upsert(array $values, array $uniqueBy, array $update)
 */

abstract class Model implements \JsonSerializable, ArrayAccess
{
    protected $table;
    protected $primaryKey = 'id';
    public $exists = false;
    protected $db;

    protected $attributes = [];
    protected $relations = [];
    
    protected $with = [];
    protected $fillable = [];
    protected $hidden = [];
    protected $appends = [];
    protected $casts = [];
    protected $timestamps = true;

    public function __construct(array $attributes = [])
    {
        $this->db = Database::getInstance();
        $this->fill($attributes);
        $this->bootGlobalScopes();
    }

    public function fill(array $attributes)
    {
        foreach ($this->filterFillable($attributes) as $key => $value) {
            $this->setAttribute($key, $value);
        }
        return $this;
    }

    public function save(array $options = [])
    {
        $query = $this->newQuery();
        
        if ($this->timestamps) {
            $this->updateTimestamps();
        }

        $attributes = $this->getAttributes();

        if ($this->exists) {
            if (empty($attributes)) return true;
            $id = $this->getKey();
            return $query->where($this->getKeyName(), $id)->update($attributes) > 0;
        } else {
            if (empty($attributes[$this->getKeyName()]) && $this->primaryKey !== 'id') {
                 $attributes[$this->getKeyName()] = $this->generateKey();
                 $this->setAttribute($this->getKeyName(), $attributes[$this->getKeyName()]);
            }
            $id = $query->insertGetId($attributes);
            if ($id) {
                if($this->primaryKey === 'id'){
                    $this->setAttribute($this->getKeyName(), $id);
                }
                $this->exists = true;
                return true;
            }
            return false;
        }
    }
    
    public function touch()
    {
        if (!$this->exists) {
            return false;
        }
        $this->updateTimestamps();
        return $this->save();
    }
    
    protected function updateTimestamps()
    {
        $time = date('Y-m-d H:i:s');
        if (!$this->exists && !isset($this->attributes['created_at'])) {
            $this->setAttribute('created_at', $time);
        }
        if (!isset($this->attributes['updated_at'])){
            $this->setAttribute('updated_at', $time);
        }
    }
    
    protected function bootGlobalScopes()
    {
        // This method will be implemented with scopes feature
    }

    public function loadRelations(array $models, array $relations)
    {
        if (empty($relations) || empty($models)) {
            return $models;
        }

        $parsed = [];
        foreach ($relations as $name => $constraints) {
            if (is_numeric($name)) {
                $name = (string) $constraints;
            }
            $dot = strpos($name, '.');
            if ($dot !== false) {
                $base = substr($name, 0, $dot);
                $nested = substr($name, $dot + 1);
                if (!isset($parsed[$base])) {
                    $parsed[$base] = [];
                }
                $parsed[$base][] = $nested;
            } else {
                if (!isset($parsed[$name])) {
                    $parsed[$name] = [];
                }
            }
        }

        foreach ($parsed as $name => $nested) {
            $constraints = function () {};

            $relationInstance = $this->{$name}();
            
            $results = null;

            if ($relationInstance->isMorphTo()) {
                $this->loadMorphTo($models, $name, $constraints);
                $results = [];
            } else {
                $this->loadEagerRelation($models, $name, $constraints);
                
                $results = [];
                foreach ($models as $model) {
                    $relationValue = $model->getAttribute($name);
                    if ($relationValue instanceof Model) {
                        $results[spl_object_hash($relationValue)] = $relationValue;
                    } elseif (is_iterable($relationValue)) {
                        foreach ($relationValue as $item) {
                            if ($item instanceof Model) $results[spl_object_hash($item)] = $item;
                        }
                    }
                }
            }

            if (!empty($nested) && !empty($results)) {
                $results = array_values($results);
                $firstResult = $results[0];
                $firstResult->loadRelations($results, $nested);
            }
        }

        return $models;
    }

    protected function loadEagerRelation(array $models, string $name, Closure $constraints)
    {
        $relation = $this->{$name}();
        $relation->addEagerConstraints($models);
        $constraints($relation);
        $results = $relation->get();
        $relation->match($models, $results, $name);
    }
    
    protected function loadMorphTo(array &$models, string $name, Closure $constraints)
    {
        $relation = $this->{$name}();
        $morphType = $relation->getMorphType();
        $morphId = $relation->getForeignKeyName();
        
        $grouped = [];
        foreach ($models as $model) {
            if ($type = $model->$morphType) {
                $grouped[$type][$model->$morphId][] = $model;
            }
        }

        foreach ($grouped as $type => $ids) {
            $instance = new $type;
            $results = $instance->query()->whereIn($instance->getKeyName(), array_keys($ids))->get();
            
            foreach ($results as $result) {
                foreach ($ids[$result->getKey()] as $model) {
                    $model->setRelation($name, $result);
                }
            }
        }
    }

    public function loadCounts(array $models, array $relations)
    {
        return $this->loadAggregates($models, $relations, 'count', '*');
    }

    public function loadAggregates(array $models, array $relationData, string $defaultFunction = null, string $defaultColumn = null)
    {
        if (empty($models)) {
            return $models;
        }

        foreach ($relationData as $data) {
            $relationName = is_array($data) ? $data['relation'] : $data;
            $function = is_array($data) ? ($data['function'] ?? $defaultFunction) : $defaultFunction;
            $column = is_array($data) ? ($data['column'] ?? $defaultColumn) : $defaultColumn;

            $parts = explode(' as ', $relationName);
            $relation = $parts[0];
            $alias = $parts[1] ?? $relation . '_' . $function;

            $relationInstance = $this->{$relation}();

            $qualifiedForeignKey = $relationInstance->getForeignKeyName();
            $foreignKeyParts = explode('.', $qualifiedForeignKey);
            $unqualifiedForeignKey = end($foreignKeyParts);
            
            $localKey = $relationInstance->getLocalKeyName();

            $modelKeys = array_unique(array_filter(array_map(function ($model) use ($localKey) {
                return $model->getAttribute($localKey);
            }, $models)));

            if (empty($modelKeys)) {
                foreach ($models as $model) {
                    $model->setAttribute($alias, 0);
                }
                continue;
            }

            $results = $relationInstance->getRelated()->query()
                ->selectRaw("{$qualifiedForeignKey}, {$function}({$column}) as aggregate")
                ->whereIn($qualifiedForeignKey, $modelKeys)
                ->groupBy($qualifiedForeignKey)
                ->get();

            $dictionary = [];
            foreach ($results as $result) {
                $key = is_object($result) ? $result->getAttribute($unqualifiedForeignKey) : $result[$unqualifiedForeignKey];
                $value = is_object($result) ? $result->getAttribute('aggregate') : $result['aggregate'];
                $dictionary[$key] = $value;
            }

            foreach ($models as $model) {
                $modelKey = $model->getAttribute($localKey);
                $count = isset($dictionary[$modelKey]) ? (int)$dictionary[$modelKey] : 0;
                $model->setAttribute($alias, $count);
            }
        }

        return $models;
    }

    protected function hasMany($relatedClass, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?? $this->primaryKey;
        return new Relation('hasMany', $this, new $relatedClass, $foreignKey, $localKey);
    }

    protected function belongsTo($relatedClass, $foreignKey, $ownerKey = 'id')
    {
        return new Relation(
            'belongsTo',
            $this,
            new $relatedClass,
            $foreignKey,
            null,
            null,
            $ownerKey
        );
    }

    protected function hasOne($relatedClass, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?? $this->primaryKey;
        return new Relation('hasOne', $this, new $relatedClass, $foreignKey, $localKey);
    }
    
    protected function belongsToMany($relatedClass, $pivotTable, $foreignPivotKey, $relatedPivotKey, $localKey = null, $relatedKey = null)
    { 
        $localKey = $localKey ?? $this->primaryKey;
        $relatedKey = $relatedKey ?? (new $relatedClass)->getKeyName();
        return new Relation('belongsToMany', $this, new $relatedClass, $foreignPivotKey, $localKey, $pivotTable, $relatedPivotKey, $relatedKey);
    }

    public function morphTo($name = null, $type = null, $id = null)
    {
        $name = $name ?? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        $type = $type ?? $name.'_type';
        $id = $id ?? $name.'_id';
        return new Relation('morphTo', $this, null, $id, $type);
    }

    protected function morphMany($relatedClass, $name)
    {
        $type = $name.'_type';
        $id = $name.'_id';
        return new Relation('morphMany', $this, new $relatedClass, $id, $this->getKeyName(), null, $type);
    }

    public function replicate(array $except = null)
    {
        $attributes = $this->attributes;
        unset($attributes[$this->getKeyName()]);
        if (!is_null($except)) {
            $attributes = array_diff_key($attributes, array_flip($except));
        }
        return new static($attributes);
    }
    
    public static function all() { return static::query()->get(); }
    public static function find($id) { return static::query()->find($id); }
    public static function findOrFail($id) { return static::query()->findOrFail($id); }
    public static function with(array $relations) { return static::query()->with($relations); }
    public static function withCount(array $relations) { return static::query()->withCount($relations); }
    public static function where($column, $operator = null, $value = null) { return static::query()->where(...func_get_args()); }
    public static function latest(string $column = 'created_at') { return static::query()->latest($column); }
    public static function oldest(string $column = 'created_at') { return static::query()->oldest($column); }

    public static function query(): QueryBuilder
    {
        return (new static)->newQuery();
    }
    
    public function newQuery(): QueryBuilder
    {
        $query = (new QueryBuilder(Database::getInstance()))->setModel($this);
        // This is where global scopes would be applied
        return $query;
    }
    
    public function newQueryWithoutScopes(): QueryBuilder
    {
        $query = (new QueryBuilder(Database::getInstance()))->setModel($this);
        return $query;
    }

    public function getTable()
    {
        if (empty($this->table)) {
            $class = new ReflectionClass($this);
            return strtolower($class->getShortName()) . 's';
        }
        return $this->table;
    }

    public function hydrate(array $results): array
    {
        return array_map(function($result) {
            $model = new static;
            $model->setRawAttributes((array) $result, true);
            return $model;
        }, $results);
    }

    public function setRawAttributes(array $attributes, $sync = false)
    {
        $this->attributes = $attributes;
        if ($sync) $this->exists = true;
        return $this;
    }

    public function getKey() { return $this->getAttribute($this->getKeyName()); }
    
    public function getKeyName(): string 
    { 
        return $this->primaryKey; 
    }
    
    public function getQualifiedKeyName() { return $this->getTable().'.'.$this->getKeyName(); }

    public function getAttributes() { return $this->attributes; }

    public function getAttribute($key) {
        if (array_key_exists($key, $this->attributes)) {
            $value = $this->attributes[$key];
            if ($this->hasGetMutator($key)) {
                return $this->mutateAttribute($key, $value);
            }
            if (isset($this->casts[$key])) {
                return $this->castAttribute($key, $value);
            }
            return $value;
        }
        if (array_key_exists($key, $this->relations)) return $this->relations[$key];
        if ($this->hasGetMutator($key)) return $this->mutateAttribute($key, null);
        if (method_exists($this, $key)) return $this->getRelationValue($key);
        return null;
    }

    public function setAttribute($key, $value) {
        if ($this->hasSetMutator($key)) {
            $this->mutateAttributeForSet($key, $value);
        } else {
            $this->attributes[$key] = $value;
        }
    }
    
    public function setRelation($relation, $value) {
        $this->relations[$relation] = $value;
        return $this;
    }

    protected function getRelationValue($key) {
        if(array_key_exists($key, $this->relations)) {
            return $this->relations[$key];
        }
        $value = $this->$key();
        if (!$value instanceof Relation) return $value;
        $results = $value->getResults();
        return $this->setRelation($key, $results);
    }

    protected function hasGetMutator($key): bool
    {
        return method_exists($this, 'get' . str_replace('_', '', ucwords($key, '_')) . 'Attribute');
    }

    protected function hasSetMutator($key): bool
    {
        return method_exists($this, 'set' . str_replace('_', '', ucwords($key, '_')) . 'Attribute');
    }

    protected function mutateAttribute($key, $value)
    {
        return $this->{'get' . str_replace('_', '', ucwords($key, '_')) . 'Attribute'}($value);
    }

    protected function mutateAttributeForSet($key, $value)
    {
        $this->{'set' . str_replace('_', '', ucwords($key, '_')) . 'Attribute'}($value);
    }

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) return null;
        switch ($this->casts[$key]) {
            case 'int':
            case 'integer':
                return (int) $value;
            case 'real':
            case 'float':
            case 'double':
                return (float) $value;
            case 'string':
                return (string) $value;
            case 'bool':
            case 'boolean':
                return (bool) $value;
            case 'object':
                return json_decode($value);
            case 'array':
            case 'json':
                return json_decode($value, true);
            case 'date':
                return \DateTime::createFromFormat('Y-m-d', $value)->setTime(0, 0, 0);
            case 'datetime':
                return \DateTime::createFromFormat('Y-m-d H:i:s', $value);
            default:
                return $value;
        }
    }

    public function toArray(): array
    {
        $attributes = [];
        foreach($this->getAttributes() as $key => $value) {
            $attributes[$key] = $this->getAttribute($key);
        }

        foreach ($this->relations as $key => $relation) {
            if (is_array($relation)) {
                $attributes[$key] = array_map(function ($item) {
                    return $item instanceof Model ? $item->toArray() : $item;
                }, $relation);
            } elseif ($relation instanceof Model) {
                $attributes[$key] = $relation->toArray();
            } else {
                $attributes[$key] = $relation;
            }
        }
        
        foreach ($this->appends as $key) {
            $attributes[$key] = $this->getAttribute($key);
        }

        return array_diff_key($attributes, array_flip($this->hidden));
    }

    public function jsonSerialize(): mixed { return $this->toArray(); }
    public function __get($key) { return $this->getAttribute($key); }
    public function __set($key, $value) { $this->setAttribute($key, $value); }
    public function offsetExists($offset): bool { return $this->getAttribute($offset) !== null; }
    public function offsetGet($offset): mixed { return $this->getAttribute($offset); }
    public function offsetSet($offset, $value): void { $this->setAttribute($offset, $value); }
    public function offsetUnset($offset): void { unset($this->attributes[$offset], $this->relations[$offset]); }
    
    public function __call($method, $parameters) {
        if (method_exists($this, 'scope'.ucfirst($method))) {
            return $this->{'scope'.ucfirst($method)}($this->newQuery(), ...$parameters);
        }
        return $this->newQuery()->$method(...$parameters);
    }
    
    public static function __callStatic($method, $parameters) {
        return static::query()->$method(...$parameters);
    }
    
    protected function generateKey()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    private function requireDatabase(): void { if (!Database::isEnabled()) throw new Exception("Database is not enabled."); }
    protected function filterFillable(array $data): array
    {
        if (empty($this->fillable)) return $data;
        return array_intersect_key($data, array_flip($this->fillable));
    }
}
