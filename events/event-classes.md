---
description: >-
  An event class is a data container which holds the information related to the
  event.
---

# Event Classes

### Defining Events

 For example, let's assume our generated `UserAuthenticated` event is to be defined and will transport an Elegant `Model` or a `collection` of `Elegant` Models to its handlers;

```php
<?php

namespace App\Events;

use Yuga\Events\Dispatcher\Dispatcher;

class UserAuthenticated extends Dispatcher
{
    /**
     * Event Name
     */
    protected $name = 'on:userauthenticated';
}
```

The above code is a result of the `php yuga make:event UserAuthenticated` command

