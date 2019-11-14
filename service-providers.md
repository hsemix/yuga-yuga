---
description: >-
  Service providers are the central place for all Yuga application service
  registering.
---

# Service Providers

Your own application, as well as all of Yuga's core services are registered via service providers. These include:

* Elegant Database 
* View
* Validation
* Session
* Events
* Router
* Console Application, to name but a few.

 Registered Service Providers are found in `config/ServiceProviders.php` When the file is opened, you will see an array return from that file which array contains all the registered `service providers`, When you create a service provider using a `yuga command`, this is where it's registered, you can also insert it there by hand if you will.

### [Creating Service Providers](https://yuga-framework.gitbook.io/documentation/service-providers#creating-service-providers)

All service providers extend the `Yuga\Providers\ServiceProvider` class and they all contain a `load` method, other methods may be introduce in future and we'll let you know. Use the `load` method to bind everything you want to use in you application.

The Yuga command used to generate a service provider is as below:

```text
php yuga make:provider LogServiceProvider
```

