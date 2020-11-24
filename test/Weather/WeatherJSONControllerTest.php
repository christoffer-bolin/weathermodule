<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Weather\WeatherJSONController;

/**
 * test the ValidateIpRestController
 */
class WeatherJSONControllerTest extends TestCase
{
    // Create the di container.
    public $di;
    public $controller;

    /**
     * Prepare before each test.
     */
    public function setUp()
    {
        // di setup
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $this->controller = new WeatherJSONController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }

    /**
     * test the validator returning result in JSON-format
     */
    public function testcheckWeatherRestActionPrognos()
    {
        $_GET["location"] = "56.16280,15.58697";
        $_GET["type"] = "prognosAPI";
        $res = $this->controller->checkWeatherRestAction();
        $this->assertIsArray($res);
    }

    public function testcheckWeatherRestActionHistory()
    {
        $_GET["location"] = "56.16280,15.58697";
        $_GET["type"] = "historyAPI";
        $res = $this->controller->checkWeatherRestAction();
        $this->assertIsArray($res);
    }


    public function testcheckWeatherRestActionPrognosIP()
    {
        $_GET["location"] = "85.24.145.234";
        $_GET["type"] = "prognosAPI";
        $res = $this->controller->checkWeatherRestAction();
        $this->assertIsArray($res);
    }

    public function testcheckWeatherRestActionHistoryIP()
    {
        $_GET["location"] = "85.24.145.234";
        $_GET["type"] = "historyAPI";
        $res = $this->controller->checkWeatherRestAction();
        $this->assertIsArray($res);
    }

    public function testcheckWeatherRestActionHistoryWrongInput()
    {
        $_GET["location"] = "testingwronginput";
        $_GET["type"] = "historyAPI";
        $res = $this->controller->checkWeatherRestAction();
        $this->assertIsArray($res);
    }
}
