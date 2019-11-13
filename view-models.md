---
description: >-
  A Yuga ViewModel is a special class that represents the data model used in a
  specific view.
---

# ViewModels

### What is a ViewModel?, What makes it different from a controller?

In a `yuga` application, every view has a `code behind file`which in this case is our view model, `View models` can work as `controllers` but the main difference lies in how they couple with views, a `controller` can return any view and it doesn't interact with the view itself while a `view model` interacts directly with the view and returns only that view. In fact, you don't tell it the view it has to return, It already knows it.

A view model in a yuga application binds a form to a real database `model` such that the developer doesn't need to the mapping of form fields to a model them selves. 

It has `automatic validation` of form fields. This can turn out to be a time saver, if custom validation is needed, a `validate` method is provided to a model to which the view model is bound and the view model will run that method instead of the default.

> While you can do pretty much everything from within a controller, a view model simplifies your work by taking away tasks like `validation` and `form-model` binding.

### Basic ViewModels

#### Defining ViewModels

Below is an example of a basic ViewModel class. Note that the ViewModel extends the base ViewModel class that comes with Yuga. The base class provides a few convenience methods such as the `onPost, onLoad, onGet` methods, which can be used whenever those events occur.

{% tabs %}
{% tab title="app/ViewModels/UserViewModel.php" %}
```php
namespace App\ViewModels;

class UserViewModel extends App
{
    /**
     * Create a new UserViewModel ViewModel instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle any form data that has been submited
     */
    public function onPost($model)
    {
        
    }

    /**
     * Load or / manupulate data when its a get request
     */
    public function onGet()
    {
        
    }

    /**
     * Load or / manupulate data before the page loads and feed it to the page
     */
    public function onLoad()
    {
        
    }
}
```
{% endtab %}
{% endtabs %}

What's in the App class that the above class is extending? Let's find out

{% tabs %}
{% tab title="app/ViewModels/App.php" %}
```php
namespace App\ViewModels;

use Yuga\View\ViewModel;
use Yuga\Views\Widgets\Menu\Menu;

abstract class App extends ViewModel
{
    protected $applicationMenu;
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Yuga Framework';
        $this->getSite()->setTitle('Welcom to ' . $this->name)
                        ->addCss(assets('yuga/bootstrap/css/bootstrap.min.css'))
                        ->addCss(assets('yuga/css/yuga.css'))
                        ->addJs(assets('yuga/js/jQuery/jquery-2.2.3.min.js'))
                        ->addJs(assets('yuga/bootstrap/js/bootstrap.min.js'))
                        ->addJs(assets('yuga/js/yuga.client.js'));
        $this->makeMenu();
    }

    protected function makeMenu()
    {
        $this->applicationMenu = new Menu;
        $this->applicationMenu->addClass('nav navbar-nav');
        if (\Auth::authRoutesExist()) {
            if (\Auth::guest()) {
                $this->applicationMenu->addItem('Login', route('login'))->addClass('nav-item')->addLinkAttribute('class', 'nav-link');
                $this->applicationMenu->addItem('Register', route('register'))->addClass('nav-item')->addLinkAttribute('class', 'nav-link');
            } else {
                $this->applicationMenu->addItem('Logout', route('/logout'))->addClass('nav-item')->addLinkAttribute('class', 'nav-link');
            }
        }
    }
    protected function printMenu()
    {
        return $this->applicationMenu;
    }
}

```
{% endtab %}
{% endtabs %}

The route that corresponds to this `UserViewModel` is as below:

{% tabs %}
{% tab title="routes/web.php" %}
```php
Route::get('add-users', App\ViewModels\UserViewModel::class);
```
{% endtab %}
{% endtabs %}

#### [Dependency Injection & ViewModels](http://yuga-framework.gitbook.io/documentation/view-models)

**Constructor Injection**

The Yuga [service container](https://yuga-framework.gitbook.io/documentation/providers) is used to resolve all Yuga ViewModels. As a result, you are able to type-hint any dependencies your ViewModel may need in its constructor. The declared dependencies will automatically be resolved and injected into the ViewModel instance:

{% tabs %}
{% tab title="app/ViewModels/UserViewModel.php" %}
```php
namespace App\ViewModels;

use App\Models\User;

class UserViewModel extends App
{
    /**
     * The user model instance.
     */
    protected $user;

    /**
     * Create a new UserViewModel ViewModel instance.
     *
     * @param  User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
```
{% endtab %}
{% endtabs %}

**Creating ViewModels using yuga console command**

ViewModels can be created using the `php yuga make:viewmodel` command

i.e `php yuga make:viewmodel UserViewModel` would produce the following scaffold:

{% tabs %}
{% tab title="app/ViewModels/UserViewModel.php" %}
```php
namespace App\ViewModels;

class UserViewModel extends App
{
    /**
     * Create a new UserViewModel ViewModel instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle any form data that has been submited
     */
    public function onPost()
    {
        
    }

    /**
     * Load or / manupulate data when its a get request
     */
    public function onGet()
    {
        
    }

    /**
     * Load or / manupulate data before the page loads and feed it to the page
     */
    public function onLoad()
    {
        
    }
}
```
{% endtab %}
{% endtabs %}

## Model binding to the **ViewModel**

Think of this as an easier way of mapping every form value to an appropriate Object attribute or property. In **`yuga`**, this works like magic.  
 When a form is submitted, the **`ViewModel`** looks for the bound Model from the scope and every form field a property on that **`Model`** and finally tries to run a `validator` to every field on the form to make sure that every form field is not empty for starters.

### Basic Structure

When a form is submitted and it is a post request method, the **`onPost`** method is run and so this is where your code for form manipulation should reside.

Example of a view \(`My.php`\)

{% tabs %}
{% tab title="My.php" %}
```php
<div class="row">
    <div class="col-md-6 col-md-offset-3 main-users-form-border">
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>
            <div class="panel-body">
                <?=$this->form()->start('user', 'post')->addClass('yuga-form'); ?>
                    <?=$this->showSuccessMessage()?>
                    <?=$this->validatedField('first_name')?>
                    <?=$this->validatedField('last_name')?>
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <?=$this->form()->button('Save', 'submit')->addClass('btn btn-primary'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div><br />
                    <?=$this->showErrors()?>
                <?=$this->form()->end() ?>
            </div>
        </div>
    </div>
</div>
```
{% endtab %}
{% endtabs %}

The code behind to the above view is below: \(`MyViewModel.php`\)

{% tabs %}
{% tab title="MyViewModel.php" %}
```php
<?php

namespace App\ViewModels;

use Yuga\Models\ElegantModel;

class MyViewModel extends App
{
    /**
     * Create a new MyViewModel ViewModel instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handle any form data that has been submited
     */
    public function onPost($model)
    {
        
    }

    /**
     * Load or / manupulate data when its a get request
     */
    public function onGet()
    {
        
    }

    /**
     * Load or / manupulate data before the page loads and feed it to the page
     */
    public function onLoad()
    {
        
    }
}
```
{% endtab %}
{% endtabs %}

The route corresponding to the above `ViewModel` could be any route but Let’s say that its:

{% tabs %}
{% tab title="routes/web.php" %}
```php
Route::all("/my-view-model", App\ViewModels\MyViewModel::class);
```
{% endtab %}
{% endtabs %}

The `model` in parameter in the **`onPost`** method in the **`MyViewModel`** **`ViewModel`**, is the bound model to the form inside the **`My.php`** html file. It can only be an instance of **`Yuga\Database\Elegant\Model`** for it to work well with the **`ViewModel`**.

By default, the bound model is **`Yuga\Models\ElegantModel`**

```php
/**
 * Handle any form data that has been submited
 */
public function onPost($model)
{
    $model->save();
}
```

Like the code above, you just have to call the save method to the model since it’s an instance of **`Yuga\Database\Elegant\Model`,** When the save method is called, It will try to **`insert`** or **`update`** the database table depending on the bound **`model`**



