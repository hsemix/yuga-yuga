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

{% code-tabs %}
{% code-tabs-item title="app/ViewModels/UserViewModel.php" %}
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
{% endcode-tabs-item %}
{% endcode-tabs %}

What's in the App class that the above class is extending? Let's find out

{% code-tabs %}
{% code-tabs-item title="app/ViewModels/App.php" %}
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
{% endcode-tabs-item %}
{% endcode-tabs %}

The route that corresponds to this `UserViewModel` is as below:

{% code-tabs %}
{% code-tabs-item title="routes/web.php" %}
```php
Route::get('add-users', App\ViewModels\UserViewModel::class);
```
{% endcode-tabs-item %}
{% endcode-tabs %}

#### [Dependency Injection & ViewModels](http://yuga-framework.gitbook.io/documentation/view-models)

**Constructor Injection**

The Yuga [service container](https://yuga-framework.gitbook.io/documentation/providers) is used to resolve all Yuga controllers. As a result, you are able to type-hint any dependencies your ViewModel may need in its constructor. The declared dependencies will automatically be resolved and injected into the ViewModel instance:

{% code-tabs %}
{% code-tabs-item title="app/ViewModels/UserViewModel.php" %}
```php
namespace App\ViewModels;

use App\Models\User;

class UserViewModel extends App
{
    /**
     * The posts model instance.
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
{% endcode-tabs-item %}
{% endcode-tabs %}

