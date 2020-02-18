---
description: Events are a very important aspect of applications nowadays.
---

# Events

In a typical **yuga** application, events are triggered almost everywhere in the entire application, i.e, when someone `loads` your application, the `on:start` event is triggered, when someone `queries` the database, the `on:query` event is triggered, when someone `logs in`to your application, the `on:authenticate` event is triggered, when someone `logs out`, the `on:logout` event is triggered.  
All the mentioned events are **built-in events** that come with yuga, of course someone can define their own events and trigger them any where in the application

The idea behind events is the ability to send data, as parameters, to handlers and call them when an event happens. The handlers could be a closure or a static class method, or even an instance object method.

### Registering Events & Handlers

All application events in a typical **yuga** application live in `config/AppEvents.php` file, which returns an array of events and their handlers or listeners.

This is the format of registering the events and binding them to their respective handlers or listeners for that matter;

```php
<?php
// in the config/AppEvents.php file
/**
 * Register all your app's events here
 * In the form of 
 * 'eventname' => App\Handlers\EventHandler::class || [EventHandlerClass1::class, EventHandlerClass2::class]
 *  OR
 * 'eventname'  => '\App\Handlers\EventHandler'
 */
return [
	'on:authenticate' => [
		App\Handlers\UserAuthenticated::class,
		App\Handlers\LogToFile::class,
	],
];

// you can also use the following format for a single handler per event
return [
	'on:authenticate' => \App\Handlers\UserAuthenticated::class,
	'onTest' => [
		['\App\Handlers\UserAuthenticated', 'onTest']
	],
];

// For any other method in the handler class other than the handle method
return [
	'on:authenticate' => [
		['\App\Handlers\UserAuthenticated', 'onLogin']
	],
	'onTest' => [
		['\App\Handlers\UserAuthenticated', 'onTest'],
		['\App\Handlers\UserTesting', 'whenSuccessful']
	],
];
```

### Dispatching Events

 To dispatch an event, you may pass an instance of the event to the `event` helper function. The helper function will dispatch the event to all of its registered handlers. Since the `event` helper function is globally available, you may call it from anywhere in your application:

```php
<?php

namespace App\Controllers;

use App\Events\TestEvent;

class UserController extends Controller
{
    /**
     * Dispatch the test-event.
     *
     * @param  int  $userId
     * @return Response
     */
    public function edit(int $userId)
    {
        $user = User::findOrFail($userId);

        event(new TestEvent($user));
        // or if the event-name is on:test
        event('on:test', compact('user'));
    }
}
```

Or You can dispatch it in the following way

```php
<?php

namespace App\Controllers;

use Yuga\Events\Event;
use App\Events\TestEvent;

class UserController extends Controller
{
    /**
     * Dispatch the test-event.
     *
     * @param  int  $userId
     * @return Response
     */
    public function edit(int $userId, Event $event)
    {
        $user = User::findOrFail($userId);

        $event->trigger(new TestEvent($user)); // u can also use the dispatch(event) method
        // or if the event-name is on:test
        $event->trigger('on:test', compact('user')); // u can also use the dispatch(event) method
    }
}
```

