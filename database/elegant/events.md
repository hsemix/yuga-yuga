---
description: >-
  The Elegant ORM emits events at different intervals whenever something
  happens, You just have to hook into them.
---

# Events

### Triggering model events.

Whenever a model is accessed, whether by querying the database for records or inserting a record or updating a record or even deleting a record, events are triggered, they include:

* onCreating
* onCreated
* onSaving
* onSaved
* onUpdating
* onUpdated
* onDeleting
* onDeleted
* onSelecting
* onSelected

Each of the events is a method that you have to implement in your model as follows:

Let's say that you want to return all **fullnames** in **upper case** of users that exist in the database after you have selected them, this is how you would do it.

```php
<?php
namespace App\Models;

use Yuga\Models\ElegantModel as Elegant;

class User extends Elegant
{
    /**
     * @param \Yuga\Database\Elegant\Builder $query
     * @param \Yuga\Database\Elegant\Collection $results
     */
    public function onSelected($query, $results)
    {
        return $results->map(function ($user) {
            $user->fullname = strtoupper($user->fullname);
            return $user;
        });
    }
}
```

