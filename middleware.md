---
description: >-
  Middleware provide a convenient mechanism for filtering HTTP requests entering
  your application. i.e, Yuga includes a middleware that verifies whether the
  user of your application is authenticated.
---

# Middleware

If the user is not authenticated, the middleware will redirect the user to the login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application.

Of course, additional middleware can be written to perform a variety of tasks besides authentication. 

There are several middleware that come with yuga-framework, including middleware for authentication and CSRF protection. App middlew middleware are located in the `app/Middleware` directory, but the ones that come with the framework are distributed across the entire framework depending on what they accomplish.

