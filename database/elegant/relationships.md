---
description: >-
  Elegant gives you an elegant where of defining and querying database table
  relationships using Models
---

# Relationships

## Defining Relationships

## \`\`[`One to One`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-on)\`\`

A one-to-one relationship is a very basic relation. For example, a `User` model might be `related` with one `Email`. To define this relationship, we place a `email` method on the `User`model. The `email` method should call the `hasOne` method and return its result:

```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * Get the phone related with the user.
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

{% hint style="info" %}
Note that we have not specified the namespace of the **Email::class**`, This is because Elegant tries to resolve model namespaces according to the namespace in which model that has called a relation is. In this case` **`\App\Models.`** `This behave can be change ofcourse by passing the fully qualified class name. i.e.` **`\App\MyModels\Email::class`** `or` 

**`'\App\MyModels\Email'`**
{% endhint %}

## \`\`[`One to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many)\`\`

## \`\`[`One to Many Inverse`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#one-to-many-inverse)\`\`

## \`\`[`Many to Many`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#many-to-many)\`\`

## \`\`[`Polymorphic Relations`](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships#polymorphic-relations)\`\`

