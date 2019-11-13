---
description: >-
  Event handlers are classes that carry the logic of the events defined in
  previous sections
---

# Event Handlers

### Defining Handlers

```php
<?php

/**
 * This file is auto-generated.
 */
 
namespace App\Handlers;

use Yuga\EventHandlers\HandlerInterface;

class WhenAuthenticated implements HandlerInterface
{
	/**
	 * Event Handler Logic here
	 * @param \Yuga\Events\Dispatcher $event
	 * @return mixed
	 */
	public function handle($event)
	{
		return null;
	}


	/**
	 * Your Event Handler Logic here
	 * @param \Yuga\Events\Dispatcher $event
	 * @return mixed
	 */
	public function isAuthentic($event)
	{
		return null;
	}
}
```

The above code is a result of the:

```bash
php yuga event:handler WhenAuthenticated --event=on:userauthenticated --method=i
sAuthentic
```

> The `--method` flag in the above comment is optional, and if not provided, the handler will register with the `handle` method.
>
> Even the `--event` is also optional but we strongly advise to always provide it, because when it's not provided, **yuga-auto-events** will be the registered event

