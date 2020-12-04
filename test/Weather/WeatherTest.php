<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\Configure\Configuration;
use PHPUnit\Framework\TestCase;
use Anax\Weather\WeatherController;
use Anax\Models\WeatherForecast;

/**
 * test the ValidateIpController.
 */
class WeatherTest extends TestCase
{
    // Create the di container.
    public $di;
    public $controller;

    /**
     * Prepare before each test.
     */

    public function setUp()
    {

        global $di;

        // di setup
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        //$this->di = $di;

        // $cfg = new Configuration();
        // $cfg->setBaseDirectories([ANAX_INSTALL_PATH . "/config"]);
        // $this->di->set("configuration", $cfg);

        // Use a different cache dir for unit test
        //$this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $this->controller = new WeatherController();
        $this->controller->setDI($di);
        //$this->controller->initialize();
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
    }


    public function testCheckWeatherCordinates()
    {
        $weather = new WeatherForecast();
        $res = $weather->checkWeather($lan = "56.16280", $lon = "15.58697");

        $this->assertIsArray($res);
    }
}
