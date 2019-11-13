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

{% hint style="info" %}
If the provided event name is a valid php class, the class will be injected in the event method provided as below.
{% endhint %}

For the following command

```bash
php yuga event:handler WhenAuthenticated --event=Test --method=i
sAuthentic
```

```php
<?php

/**
 * This file is auto-generated.
 */
 
namespace App\Handlers;

use App\Events\Test;
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
	 * @param App\Events\Test $event
	 * @return mixed
	 */
	public function isAuthentic(Test $event)
	{
		return null;
	}
}
```

And the event class should be as below:

```php
<?php

namespace App\Events;

use Yuga\Events\Dispatcher\Dispatcher;

class Test extends Dispatcher
{
    /**
     * Event Name
     */
    protected $name = 'on:test';
}
```

In which case you can no longer dispatch the event like so

```php
event('on:test');
```

inside of any controller or view-model for that matter, this is because of the contract provided in the event handler, so we are left with the option of:

```php
event(new \App\Events\Test());
```

