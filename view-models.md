---
description: >-
  A Yuga ViewModel is a special class that represents the data model used in a
  specific view.
---

# ViewModels

### What is a ViewModel?, What makes it different from a controller?

In a `yuga` application, every view has a `code behind file`which in this case is our view model, `View models` can work as `controllers` but the main difference lies in how they couple with views, a `controller` can return any view and it doesn't interact with the view itself while a `view model` interacts directly with the view and returns only that view. In fact, you don't tell it the view it has to return, It already knows it.

A view model in a yuga application binds a form to a real database model such that the developer doesn't need to the mapping of form fields to a model them selves. 

It has automatic validation of form fields. This can turn out to be a time saver, if custom validation is needed, a validate method is provided to a model to which the view model is bound and the view model will run that method instead of the default.

