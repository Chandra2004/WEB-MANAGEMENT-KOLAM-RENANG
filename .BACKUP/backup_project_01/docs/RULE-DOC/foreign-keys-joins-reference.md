# 📋 Quick Reference: Foreign Keys & JOINs

## 🔑 Foreign Keys Cheat Sheet

### Creation Syntax

```php
// ⭐ RECOMMENDED: Shorthand (Auto-detect)
$table->foreignId('user_id')->constrained()->cascadeOnDelete();

// 🎯 Custom Table
$table->foreignId('author_id')->constrained('users')->cascadeOnDelete();

// 📝 Full Syntax
$table->integer('user_id')->unsigned();
$table->foreign('user_id')
      ->references('id')
      ->on('users')
      ->onDelete('cascade');
```

### Cascade Actions

| Method               | SQL Action           | Behavior                          |
| -------------------- | -------------------- | --------------------------------- |
| `cascadeOnDelete()`  | `ON DELETE CASCADE`  | Hapus child saat parent dihapus   |
| `restrictOnDelete()` | `ON DELETE RESTRICT` | Cegah hapus parent jika ada child |
| `nullOnDelete()`     | `ON DELETE SET NULL` | Set NULL saat parent dihapus      |
| `cascadeOnUpdate()`  | `ON UPDATE CASCADE`  | Update child saat parent berubah  |

### Drop Foreign Keys

```php
// By column name
$table->dropForeign(['user_id']);

// By constraint name
$table->dropForeign('posts_user_id_foreign');
```

---

## 🔀 JOINs Cheat Sheet

### All JOIN Types

```php
// INNER JOIN (default) - Matching only
->join('users', 'posts.user_id', '=', 'users.id')
->innerJoin('users', 'posts.user_id', '=', 'users.id')

// LEFT JOIN - All from left + matches
->leftJoin('users', 'posts.user_id', '=', 'users.id')

// RIGHT JOIN - All from right + matches
->rightJoin('posts', 'users.id', '=', 'posts.user_id')

// LEFT OUTER JOIN - Same as LEFT JOIN
->leftOuterJoin('users', 'posts.user_id', '=', 'users.id')

// RIGHT OUTER JOIN - Same as RIGHT JOIN
->rightOuterJoin('posts', 'users.id', '=', 'posts.user_id')

// FULL OUTER JOIN - All from both tables
->fullOuterJoin('users', 'posts.user_id', '=', 'users.id')

// CROSS JOIN - Cartesian product
->crossJoin('categories')
```

### JOIN Comparison Table

| Type       | Left Only | Match | Right Only | Total Rows   |
| ---------- | --------- | ----- | ---------- | ------------ |
| INNER      | ❌        | ✅    | ❌         | Least        |
| LEFT       | ✅        | ✅    | ❌         | More         |
| RIGHT      | ❌        | ✅    | ✅         | More         |
| FULL OUTER | ✅        | ✅    | ✅         | Most         |
| CROSS      | -         | -     | -          | Left × Right |

---

## 💻 Code Examples

### Example 1: Simple Foreign Key

```php
// Migration
Schema::create('posts', function($table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});
```

### Example 2: Multiple Foreign Keys

```php
Schema::create('comments', function($table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->cascadeOnDelete();
    $table->foreignId('user_id')->constrained()->restrictOnDelete();
    $table->text('comment');
    $table->timestamps();
});
```

### Example 3: INNER JOIN

```php
// Posts with authors only
$posts = Post::query()
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->select('posts.*', 'users.name as author')
    ->get();
```

### Example 4: LEFT JOIN (Find Orphans)

```php
// All posts (even without valid users)
$posts = Post::query()
    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->select('posts.*', 'users.name as author')
    ->get();

// Find orphaned posts
$orphaned = Post::query()
    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->whereRaw('users.id IS NULL')
    ->get();
```

### Example 5: Multiple JOINs

```php
$posts = Post::query()
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
    ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
    ->select('posts.*', 'users.name as author', 'categories.name as category')
    ->selectRaw('COUNT(comments.id) as comment_count')
    ->groupBy('posts.id', 'users.name', 'categories.name')
    ->get();
```

### Example 6: Statistics

```php
// Count posts per user
$stats = User::query()
    ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
    ->selectRaw('users.id, users.name, COUNT(posts.id) as total_posts')
    ->groupBy('users.id', 'users.name')
    ->orderBy('total_posts', 'DESC')
    ->get();
```

---

## 🎯 Decision Tree

### When to Use Foreign Keys?

```
Do you have relationships between tables?
├─ YES → Use Foreign Keys
│   ├─ Should child be deleted when parent deleted?
│   │   ├─ YES → cascadeOnDelete()
│   │   └─ NO  → restrictOnDelete() or nullOnDelete()
│   └─ Want to prevent invalid references?
│       └─ YES → Use Foreign Keys
└─ NO → No Foreign Keys needed
```

### Which JOIN to Use?

```
What data do you need?
├─ Only matching records from both tables
│   └─ Use: INNER JOIN
├─ All from left table + matching from right
│   └─ Use: LEFT JOIN
├─ All from right table + matching from left
│   └─ Use: RIGHT JOIN
├─ Everything from both tables
│   └─ Use: FULL OUTER JOIN
└─ All combinations (matrix)
    └─ Use: CROSS JOIN ⚠️ Careful!
```

---

## ⚡ Performance Tips

### DO ✅

```php
✅ Use indexes on foreign key columns
✅ Use eager loading for relationships
✅ Use JOINs for aggregations
✅ Add WHERE clauses to limit results
✅ Use LEFT JOIN to find missing data
```

### DON'T ❌

```php
❌ CROSS JOIN large tables without LIMIT
❌ JOIN without WHERE on large datasets
❌ Forget to add indexes on join columns
❌ Use JOIN when Relationships are simpler
❌ Nest too many JOINs (max 3-4)
```

---

## 🚨 Common Mistakes

### 1. Missing Unsigned on Foreign Key

```php
❌ BAD:
$table->integer('user_id');  // Not unsigned!
$table->foreign('user_id')->references('id')->on('users');

✅ GOOD:
$table->integer('user_id')->unsigned();
$table->foreign('user_id')->references('id')->on('users');

⭐ BEST:
$table->foreignId('user_id')->constrained();
```

### 2. Wrong JOIN Order

```php
❌ BAD:
// Swapped table names
->join('posts', 'users.id', '=', 'posts.user_id')  // On wrong table

✅ GOOD:
->join('users', 'posts.user_id', '=', 'users.id')
```

### 3. Forgetting to Drop Foreign Key

```php
❌ BAD:
public function down() {
    Schema::dropIfExists('posts');  // Will fail if foreign keys exist!
}

✅ GOOD:
public function down() {
    Schema::table('posts', function($table) {
        $table->dropForeign(['user_id']);
    });
    Schema::dropIfExists('posts');
}
```

---

## 📚 See Also

- 📖 Full Documentation: `docs/migrations.md`
- 📖 JOIN Guide: `docs/orm.md`
- 📖 Query Builder: `docs/query-builder.md`
- 🎨 Visual Guide: `VISUAL_GUIDE_JOINS_FOREIGN_KEYS.md`
- 📋 Examples: `app/Examples/JoinExampleController.php`

---

**Print this page for quick reference! 🖨️**
