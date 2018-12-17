# Relationships

## Defining Relationships

## \`\`[`One to One`](%20https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-one)\`\`

A one-to-one relationship is a very basic relation. For example, a `User` model might be `related` with one `Email`. To define this relationship, we place a `email` method on the `User`model. The `email` method should call the `hasOne` method and return its result:

{% code-tabs %}
{% code-tabs-item title="app/Models/User.php" %}
```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * Get the email related with the user.
     */
    public function email()
    {
        return $this->hasOne(Email::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

The first argument passed to the `hasOne` method is the name of the related model. Once the relationship is defined, you can retrieve the related record using Elegant's dynamic properties. Dynamic properties allow you to access relationship methods as if they were properties defined on the model:

```php
$phone = User::find(1)->email;
```

Elegant determines the foreign key of the relationship based on the model name. In this case, the `Email` model is automatically assumed to have a `user_id` foreign key. If you wish to override this convention, you may pass a second argument to the `hasOne` method:

```php
return $this->hasOne(Email::class, 'foreign_key');
```

Additionally, Elegant assumes that the foreign key should have a value matching the `id` \(or the custom `$primaryKey`\) column of the parent. In other words, Elegant will look for the value of the user's `id` column in the `user_id` column of the `Email` record. If you would like the relationship to use a value other than `id`, you may pass a third argument to the `hasOne`method specifying your custom key:

```php
return $this->hasOne(Email::class, 'foreign_key', 'local_key');
```

**Defining The Inverse Of The Relationship**

So, we can access the `Email` model from our `User`. Now, let's define a relationship on the `Email` model that will let us access the `User` that owns the phone. We can define the inverse of a `hasOne` relationship using the `belongsTo` method:

{% code-tabs %}
{% code-tabs-item title="app/Models/Email.php" %}
```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class Email extends Model
{
    /**
     * Get the user that owns the email.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

In the example above, Elegant will try to match the `user_id` from the `Email` model to an `id`on the `User` model. Elegant determines the default foreign key name by examining the name of the relationship method and suffixing the method name with `_id`. However, if the foreign key on the `Email` model is not `user_id`, you may pass a custom key name as the second argument to the `belongsTo` method:

```php
/**
 * Get the user that owns the email.
 */
public function user()
{
    return $this->belongsTo(User::class, 'foreign_key');
}
```

If your parent model does not use `id` as its primary key, or you wish to join the child model to a different column, you may pass a third argument to the `belongsTo` method specifying your parent table's custom key:

```php
/**
 * Get the user that owns the email.
 */
public function user()
{
    return $this->belongsTo(User::class, 'foreign_key', 'other_key');
}
```

{% hint style="info" %}
Note that we have not specified the namespace of the **Email::class**`, This is because Elegant tries to resolve model namespaces according to the namespace in which model that has called a relation is. In this case` **`\App\Models.`** `This behaviour can be change ofcourse by passing the fully qualified class name. i.e.` **`\App\MyModels\Email::class`** `or` 

**`'\App\MyModels\Email'`**
{% endhint %}

## \`\`[`One to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many)\`\`

#### One To Many

A "one-to-many" relationship is used to define relationships where a single model owns any amount of other models. For example, a blog post may have an infinite number of comments. Like all other `Elegant` relationships, one-to-many relationships are defined by placing a function on your Elegant model:

{% code-tabs %}
{% code-tabs-item title="app/Models/Post.php" %}
```php
<?php

namespace App\Mdoels;

use Yuga\Database\Elegant\Model;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

Remember, Elegant will automatically determine the proper foreign key column on the `Comment` model. By convention, Elegant will take the "snake case" name of the owning model and suffix it with `_id`. So, for this example, Elegant will assume the foreign key on the `Comment` model is `post_id`.

Once the relationship has been defined, we can access the collection of comments by accessing the `comments` property. Remember, since Elegant provides "dynamic properties", we can access relationship methods as if they were defined as properties on the model:

```php
$comments = App\Models\Post::find(1)->comments;

foreach ($comments as $comment) {
    //your code
}
```

Of course, since all relationships also serve as query builders, you can add further constraints to which comments are retrieved by calling the `comments` method and continuing to chain conditions onto the query:

```php
$comment = App\Models\Post::find(1)->comments()->where('title', 'foo')->first();
```

Like the `hasOne` method, you may also override the foreign and local keys by passing additional arguments to the `hasMany` method:

```php
return $this->hasMany(Comment::class, 'foreign_key');

return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
```

## \`\`[`One to Many Inverse`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many-inverse)\`\`

#### One To Many \(Inverse\)

Now that we can access all of a post's comments, let's define a relationship to allow a comment to access its parent post. To define the inverse of a `hasMany` relationship, define a relationship function on the child model which calls the `belongsTo` method:

{% code-tabs %}
{% code-tabs-item title="app/Models/Comment.php" %}
```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class Comment extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

Once the relationship has been defined, we can retrieve the `Post` model for a `Comment` by accessing the `post` "dynamic property":

```php
$comment = App\Models\Comment::find(1);

echo $comment->post->title;
```

In the example above, Elegant will try to match the `post_id` from the `Comment` model to an `id` on the `Post` model. Elegant determines the default foreign key name by examining the name of the relationship method and suffixing the method name with a `_` followed by the name of the primary key column. However, if the foreign key on the `Comment` model is not `post_id`, you may pass a custom key name as the second argument to the `belongsTo` method:

```php
/**
 * Get the post that owns the comment.
 */
public function post()
{
    return $this->belongsTo(Post::class, 'foreign_key');
}
```

If your parent model does not use `id` as its primary key, or you wish to join the child model to a different column, you may pass a third argument to the `belongsTo` method specifying your parent table's custom key:

```php
/**
 * Get the post that owns the comment.
 */
public function post()
{
    return $this->belongsTo(Post::class, 'foreign_key', 'other_key');
}
```

## \`\`[`Many to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#many-to-many)\`\`

#### Many To Many

Many-to-many relations are slightly more complicated than `hasOne` and `hasMany`relationships. An example of such a relationship is a user with many roles, where the roles are also shared by other users. For example, many users may have the role of "Admin". To define this relationship, three database tables are needed: `users`, `roles`, and `role_user`. The `role_user` table is derived from the alphabetical order of the related model names, and contains the `user_id` and `role_id` columns.

Many-to-many relationships are defined by writing a method that returns the result of the `belongsToMany` method. For example, let's define the `roles` method on our `User` model:

{% code-tabs %}
{% code-tabs-item title="app/Models/User.php" %}
```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

Once the relationship is defined, you may access the user's roles using the `roles` dynamic property:

```php
$user = App\Models\User::find(1);

foreach ($user->roles as $role) {
    //
}
```

Of course, like all other relationship types, you may call the `roles` method to continue chaining query constraints onto the relationship:

```php
$roles = App\Models\User::find(1)->roles()->orderBy('name')->get();
```

As mentioned previously, to determine the table name of the relationship's joining table, Elegant will join the two related model names in alphabetical order. However, you are free to override this convention. You may do so by passing a second argument to the `belongsToMany`method:

```php
return $this->belongsToMany(Role::class, 'role_user');
```

In addition to customizing the name of the joining table, you may also customize the column names of the keys on the table by passing additional arguments to the `belongsToMany` method. The third argument is the foreign key name of the model on which you are defining the relationship, while the fourth argument is the foreign key name of the model that you are joining to:

```php
return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
```

**Defining The Inverse Of The Relationship**

To define the inverse of a many-to-many relationship, you place another call to `belongsToMany`on your related model. To continue our user roles example, let's define the `users` method on the `Role` model:

{% code-tabs %}
{% code-tabs-item title="app/Models/Role.php" %}
```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class Role extends Model
{
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
```
{% endcode-tabs-item %}
{% endcode-tabs %}

As you can see, the relationship is defined exactly the same as its `User` counterpart, with the exception of referencing the `App\Models\User` model. Since we're reusing the `belongsToMany` method, all of the usual table and key customization options are available when defining the inverse of many-to-many relationships.

## \`\`[`Polymorphic Relations`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#polymorphic-relations)\`\`

