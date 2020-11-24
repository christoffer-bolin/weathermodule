<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Weather\WeatherController;

/**
 * test the ValidateIpController.
 */
class WeatherControllerTest extends TestCase
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
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
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


    public function testcheckWeatherActionCoordinates()
    {
        $_GET["location"] = "56.16280,15.58697";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionCoordinatesHistory()
    {
        $_GET["location"] = "56.16280,15.58697";
         $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }


    public function testcheckWeatherActionIp()
    {
        $_GET["location"] = "85.24.145.234";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }


    public function testcheckWeatherActionIpHistory()
    {
        $_GET["location"] = "85.24.145.234";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }




    public function testcheckWeatherActionWrongInput()
    {
        $_GET["location"] = "test";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionWrongInputTwo()
    {
        $_GET["location"] = "155.22,155.22";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionWrongInputThree()
    {
        $_GET["location"] = "hej,15.58697";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionWrongInputFour()
    {
        $_GET["location"] = "test";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionWrongInputFive()
    {
        $_GET["location"] = "155.22,155.22";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionWrongInputSix()
    {
        $_GET["location"] = "hej,15.58697";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }
}
