# 📊 Visual Guide: Foreign Keys & JOINs

## 🔗 Foreign Key Relationships

### Basic Foreign Key Concept

```
┌─────────────────┐         ┌─────────────────┐
│     USERS       │         │     POSTS       │
├─────────────────┤         ├─────────────────┤
│ id (PK)         │◄────────┤ id (PK)         │
│ name            │         │ user_id (FK)    │
│ email           │         │ title           │
│ created_at      │         │ content         │
└─────────────────┘         │ created_at      │
                            └─────────────────┘

Foreign Key: posts.user_id REFERENCES users.id
```

### One-to-Many Relationship

```
        1 User
           │
           │ has many
           ▼
      Many Posts

┌──────────┐
│  USERS   │
│ id: 1    │──┐
│ name: A  │  │
└──────────┘  │
              │
              ├──► ┌────────────┐
              │    │   POSTS    │
              │    │ id: 1      │
              │    │ user_id: 1 │
              │    │ title: X   │
              │    └────────────┘
              │
              ├──► ┌────────────┐
              │    │   POSTS    │
              │    │ id: 2      │
              │    │ user_id: 1 │
              └──► │ title: Y   │
                   └────────────┘
```

### Foreign Key Actions (Cascade Examples)

#### ON DELETE CASCADE

```
Before:
USERS: [1, 'John']
POSTS: [1, 1, 'Title A']
       [2, 1, 'Title B']

DELETE FROM users WHERE id = 1;

After (CASCADE):
USERS: []
POSTS: []  ← Automatically deleted!
```

#### ON DELETE RESTRICT

```
Before:
USERS: [1, 'John']
POSTS: [1, 1, 'Title A']

DELETE FROM users WHERE id = 1;

Result: ❌ ERROR!
"Cannot delete user because posts exist"
```

#### ON DELETE SET NULL

```
Before:
USERS: [1, 'John']
POSTS: [1, 1, 'Title A']

DELETE FROM users WHERE id = 1;

After (SET NULL):
USERS: []
POSTS: [1, NULL, 'Title A']  ← user_id = NULL
```

---

## 🔀 JOIN Types Visual Guide

### Sample Data

```
USERS Table:
┌────┬──────┐
│ id │ name │
├────┼──────┤
│ 1  │ John │
│ 2  │ Jane │
│ 3  │ Bob  │
└────┴──────┘

POSTS Table:
┌────┬─────────┬────────┐
│ id │ user_id │ title  │
├────┼─────────┼────────┤
│ 1  │ 1       │ Post A │
│ 2  │ 1       │ Post B │
│ 3  │ 2       │ Post C │
│ 4  │ 99      │ Post D │ ⚠️ Orphaned (no user)
└────┴─────────┴────────┘
```

### INNER JOIN 🔗

**Result: Only matching records from both tables**

```sql
SELECT * FROM posts
INNER JOIN users ON posts.user_id = users.id
```

```
Result:
┌──────────┬─────────┬─────────┬──────────┐
│ post_id  │ user_id │ title   │ username │
├──────────┼─────────┼─────────┼──────────┤
│ 1        │ 1       │ Post A  │ John     │
│ 2        │ 1       │ Post B  │ John     │
│ 3        │ 2       │ Post C  │ Jane     │
└──────────┴─────────┴─────────┴──────────┘

❌ Post D (orphaned) excluded
❌ Bob (no posts) excluded
```

**Visual:**

```
Users          Posts
┌────┐        ┌────┐
│John├────────┤Post A│
│    ├────────┤Post B│
└────┘        └────┘
┌────┐        ┌────┐
│Jane├────────┤Post C│
└────┘        └────┘
┌────┐
│Bob │  ❌ No match
└────┘
              ┌────┐
              │Post D│ ❌ No match
              └────┘
```

---

### LEFT JOIN 👈

**Result: All records from LEFT table + matching from RIGHT**

```sql
SELECT * FROM posts
LEFT JOIN users ON posts.user_id = users.id
```

```
Result:
┌──────────┬─────────┬─────────┬──────────┐
│ post_id  │ user_id │ title   │ username │
├──────────┼─────────┼─────────┼──────────┤
│ 1        │ 1       │ Post A  │ John     │
│ 2        │ 1       │ Post B  │ John     │
│ 3        │ 2       │ Post C  │ Jane     │
│ 4        │ 99      │ Post D  │ NULL     │ ✅ Included!
└──────────┴─────────┴─────────┴──────────┘

✅ All posts included (even orphaned)
❌ Bob still excluded (no posts)
```

**Visual:**

```
Posts (ALL)     Users
┌────┐         ┌────┐
│Post A├────────┤John│
│Post B├────────┤    │
└────┘         └────┘
┌────┐         ┌────┐
│Post C├────────┤Jane│
└────┘         └────┘
┌────┐
│Post D│ ────── NULL  ✅ Still returned
└────┘
```

---

### RIGHT JOIN 👉

**Result: All records from RIGHT table + matching from LEFT**

```sql
SELECT * FROM posts
RIGHT JOIN users ON posts.user_id = users.id
```

```
Result:
┌──────────┬─────────┬─────────┬──────────┐
│ post_id  │ user_id │ title   │ username │
├──────────┼─────────┼─────────┼──────────┤
│ 1        │ 1       │ Post A  │ John     │
│ 2        │ 1       │ Post B  │ John     │
│ 3        │ 2       │ Post C  │ Jane     │
│ NULL     │ NULL    │ NULL    │ Bob      │ ✅ Included!
└──────────┴─────────┴─────────┴──────────┘

✅ All users included (even without posts)
❌ Post D excluded (orphaned)
```

**Visual:**

```
Posts          Users (ALL)
┌────┐        ┌────┐
│Post A├───────┤John│
│Post B├───────┤    │
└────┘        └────┘
┌────┐        ┌────┐
│Post C├───────┤Jane│
└────┘        └────┘
              ┌────┐
NULL ─────────┤Bob │ ✅ Still returned
              └────┘
```

---

### FULL OUTER JOIN 🔀

**Result: ALL records from BOTH tables**

```sql
SELECT * FROM posts
FULL OUTER JOIN users ON posts.user_id = users.id
```

```
Result:
┌──────────┬─────────┬─────────┬──────────┐
│ post_id  │ user_id │ title   │ username │
├──────────┼─────────┼─────────┼──────────┤
│ 1        │ 1       │ Post A  │ John     │
│ 2        │ 1       │ Post B  │ John     │
│ 3        │ 2       │ Post C  │ Jane     │
│ 4        │ 99      │ Post D  │ NULL     │ ✅ Orphaned post
│ NULL     │ NULL    │ NULL    │ Bob      │ ✅ User w/o posts
└──────────┴─────────┴─────────┴──────────┘

✅ Everyone included!
```

**Visual:**

```
Posts (ALL)    Users (ALL)
┌────┐        ┌────┐
│Post A├───────┤John│
│Post B├───────┤    │
└────┘        └────┘
┌────┐        ┌────┐
│Post C├───────┤Jane│
└────┘        └────┘
┌────┐
│Post D│────── NULL  ✅
└────┘
              ┌────┐
NULL ─────────┤Bob │ ✅
              └────┘
```

---

### CROSS JOIN ✖️

**Result: Cartesian Product (Every combination)**

```sql
SELECT * FROM posts CROSS JOIN users
```

```
Result (12 rows total):
┌──────────┬─────────┬──────────┐
│ title    │ user_id │ username │
├──────────┼─────────┼──────────┤
│ Post A   │ 1       │ John     │
│ Post A   │ 2       │ Jane     │
│ Post A   │ 3       │ Bob      │
│ Post B   │ 1       │ John     │
│ Post B   │ 2       │ Jane     │
│ Post B   │ 3       │ Bob      │
│ ...      │ ...     │ ...      │
└──────────┴─────────┴──────────┘

⚠️ WARNING: Can produce huge results!
4 posts × 3 users = 12 combinations
```

---

## 🎯 When to Use Each JOIN?

```
┌─────────────────┬───────────────────────────────────┐
│ JOIN Type       │ Use When...                       │
├─────────────────┼───────────────────────────────────┤
│ INNER JOIN      │ Only need matching records        │
│                 │ Example: Posts with valid authors │
├─────────────────┼───────────────────────────────────┤
│ LEFT JOIN       │ Need all from LEFT + matches      │
│                 │ Example: All posts + their users  │
├─────────────────┼───────────────────────────────────┤
│ RIGHT JOIN      │ Need all from RIGHT + matches     │
│                 │ Example: All users + their posts  │
├─────────────────┼───────────────────────────────────┤
│ FULL OUTER      │ Need everything from both tables  │
│                 │ Example: Complete data analysis   │
├─────────────────┼───────────────────────────────────┤
│ CROSS JOIN      │ Need all combinations             │
│                 │ Example: Product variants, matrix │
└─────────────────┴───────────────────────────────────┘
```

---

## 💡 Pro Tips

### 1. Finding Orphaned Records

```php
// Posts without valid users
$orphaned = Post::query()
    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->whereRaw('users.id IS NULL')
    ->get();
```

### 2. Finding Users Without Posts

```php
// Users who haven't posted
$inactive = User::query()
    ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
    ->whereRaw('posts.id IS NULL')
    ->get();
```

### 3. Statistics with JOIN

```php
// Count posts per user (including 0)
$stats = User::query()
    ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
    ->selectRaw('users.*, COUNT(posts.id) as post_count')
    ->groupBy('users.id')
    ->get();
```

---

**Remember:**

- ✅ Use Relationships for simple queries
- ✅ Use JOINs for complex aggregations
- ✅ Always consider performance with large datasets
- ✅ Use Foreign Keys for data integrity

**Happy Querying! 🚀**
