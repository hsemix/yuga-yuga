<?php

use Yuga\Session\Session;
use PHPUnit\Framework\TestCase;
use Yuga\Application\Application;

class ApplicationTest extends TestCase
{
    protected $app;
    public function __construct()
    {
        parent::__construct();
        $this->app = new Application('tests');
    }
    /**
     * Application Directory Test
     * 
     * @test
     * 
     * @return void
     */
    public function that_we_can_get_application_base_path()
    {
        $this->assertEquals($this->app['base_path'], 'tests');
    }

    /**
     * @test
     * 
     * @return void
     */
    public function that_session_instance_is_in_application()
    {
        $this->assertSame($this->app->make('session'), new Session);
    }   
}