<?php
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
        $this->getSite()->setTitle('Welcome to ' . $this->name)
                        ->addCss(assets('assets/css/app.css'))
                        ->addJs(assets('yuga/js/ys.min.js'));
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
                $this->applicationMenu->addItem('Logout', route('logout'))->addClass('nav-item')->addLinkAttribute('class', 'nav-link');
            }
        }
    }
    protected function printMenu()
    {
        return $this->applicationMenu;
    }
}