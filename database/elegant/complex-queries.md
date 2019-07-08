---
description: >-
  Any Query that can be written in a raw form in sql, can also be written in
  yuga with the elegant orm.
---

# Complex queries

### Writing Complex database queries with elegant

You can join tables, query from the same table as many times as you want using only the **`orm`** without having to write a custom query, much as it is possible to write a custom query using the `Elegant ORM`.  
The purpose of the `ORM` is to limit if not get rid of custom query use cases, without compromising perform and ease of development.

An example is:

```php
$user = new User;
$streams = $user->where('streamable_type', 'user')->whereNotIn('id', function($query) {
    $query->from('d_table');
    $query->where('status', '<>', 'A');
    $query->where('userStatus', 'B');
})->whereIn('id', function ($query) {
    $query->where('user_id', 'IN', function($query) {
        $query->where('userStatus', '<>', 'B')->select('id');
    });
})->orWhere('fullname', function($query) {
    $query->where('username', 'hsemix');
})->toSql('raw');
```

The above query would give the following sql:

```sql
SELECT * FROM `users` 
WHERE 
`streamable_type` = 'user' AND `id` NOT IN 
(
    SELECT `user_id` FROM `d_table` WHERE `status` <> 'A' AND `userStatus` = 'B'
) 
AND `id` IN 
(
    SELECT `id` FROM `users` WHERE `userStatus` <> 'B' AND `user_id` IN 
    (
        SELECT `id` FROM `users` WHERE `userStatus` <> 'B'
    )
) 
or `fullname` = 
(
    SELECT `fullname` FROM `users` WHERE `username` = 'hsemix'
)
```

In the above sql, you can clearly see that the results are coming from two tables, i.e; `users and d_table`

Example 2:

```php
$user = new User;
$streams = $user->from($user->subQuery($user))
                ->where('streamable_type', 'user')
                ->whereNotIn('id', function($query) {
                    $query->from('d_table');
                    $query->where('status', '<>', 'A');
                    $query->where('userStatus', 'B');
                })->whereIn('id', function ($query) {
                    $query->where('user_id', 'IN', function($query) {
                        $query->where('userStatus', '<>', 'B')->select('id');
                    });
                })->orWhere('fullname', function($query) {
                    $query->where('username', 'hsemix');
                })->toSql('raw');
```

The above would produce the following sql:

```sql
SELECT * FROM 
    (SELECT * FROM `users`) 
WHERE 
    `streamable_type` = 'user' 
AND 
    `id` 
NOT IN 
    (SELECT `user_id` FROM 
        `d_table` 
    WHERE 
        `status` <> 'A' 
    AND 
        `userStatus` = 'B') 
    AND 
        `id` 
    IN 
        (SELECT `id` FROM 
            `users` 
        WHERE 
            `userStatus` <> 'B' 
        AND 
            `user_id` 
        IN 
            (SELECT `id` FROM `users` WHERE `userStatus` <> 'B')
        ) 
    or 
        `fullname` = 
    (
        SELECT `fullname` FROM `users` WHERE `username` = 'hsemix'
    )
```

Example 3

```php
$user = new User;
$query= $user->from($user->subQuery($user))
        ->select($user->subQuery($user, 'user_name'))
        ->toSql('raw');
```

Would give the following sql:

```sql
SELECT (SELECT * FROM `users`) as user_name FROM (SELECT * FROM `users`)
```

