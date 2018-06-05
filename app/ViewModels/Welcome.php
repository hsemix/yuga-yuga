<?php
namespace App\ViewModels;

class Welcome extends App
{
    protected $appName;
    protected $templatePath = null;
    public function __construct($appName)
    {
        parent::__construct();
        $this->appName = $appName;
        //$this->setTemplate(null);
    }
    public function getAppName()
    {
        return $this->appName;
    }
}