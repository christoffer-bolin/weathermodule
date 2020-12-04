<?php

namespace Anax\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        //set a test-cache for tests
        //$di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Create and initiate the controller
        $this->controller = new WeatherControllerMock();

        $this->controller->setDi($di);
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
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "56.16280,15.58697";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionCoordinatesWrong()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "56.16280,100.58697";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionCoordinatesHistory()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "56.16280,15.58697";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionCoordinatesWrongHistory()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "91.16280,100.58697";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionCoordinatesWrongInput()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "test,test";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionHistoryWrongIp()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "8665.24.145.234";
        $_GET["type"] = "history";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }

    public function testcheckWeatherActionPrognosWrongIp()
    {
        // $_GET["lan"] = "56.16280";
        // $_GET["lon"] = "15.58697";
        $_GET["location"] = "8665.24.145.234";
        $_GET["type"] = "prognos";

        $res = $this->controller->checkWeatherAction();
        $this->assertIsObject($res);
    }
}
