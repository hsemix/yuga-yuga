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
Note that we have not specified the namespace of the **Email::class**`, This is because Elegant tries to resolve model namespaces according to the namespace in which model that has called a relation is. In this case` **`\App\Models.`** `This behave can be change ofcourse by passing the fully qualified class name. i.e.` **`\App\MyModels\Email::class`** `or` 

**`'\App\MyModels\Email'`**
{% endhint %}

## \`\`[`One to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many)\`\`

## \`\`[`One to Many Inverse`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many-inverse)\`\`

## \`\`[`Many to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#many-to-many)\`\`

## \`\`[`Polymorphic Relations`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#polymorphic-relations)\`\`

