---
description: >-
  Elegant gives you an elegant where of defining and querying database table
  relationships using Models
---

# Relationships

## Defining Relationships

## \`\`[`One to One`](%20https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-one)\`\`

A one-to-one relationship is a very basic relation. For example, a `User` model might be `related` with one `Email`. To define this relationship, we place a `email` method on the `User`model. The `email` method should call the `hasOne` method and return its result:

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
$comment = App\Comment::find(1);

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

## \`\`[`Polymorphic Relations`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#polymorphic-relations)\`\`

