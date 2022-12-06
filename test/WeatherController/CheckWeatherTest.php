<?php

namespace Anax\WeatherController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the WeatherController.
 */
class CheckWeatherTest extends TestCase
{
    /**
     * Test the function "getUserIp".
     */
    public function testGetUserIp()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $di->get("request")->setServer("REMOTE_ADDR", "127.0.0.2");
        $controller = new CheckWeather();
        $res = $controller->getUserIp($di->get("request")->getServer("REMOTE_ADDR"));
        // var_dump($res);

        $this->assertIsString($res);
    }

    /**
     * Test the function "setIp".
     */
    public function testSetIp()
    {
        $controller = new CheckWeather();
        $res = $controller->setIp("172.217.11.23");

        $this->assertNull($res);
    }

    /**
     * Test the function "getLocation".
     */
    public function testGetLocation()
    {
        $controller = new CheckWeather();
        $controller->setIp("172.217.11.23");
        $res = $controller->getLocation();

        $this->assertIsArray($res);
    }


    /**
     * Test the function "getPastDays".
     */
    public function testGetPastDays()
    {
        $controller = new CheckWeather();
        $res = $controller->getPastDays(5);

        $this->assertIsArray($res);
    }


    /**
     * Test the function "getResult".
     */
    // public function testGetResult()
    // {
    //     $controller = new CheckWeather();
    //     $result = $controller->getWeather("56.1619112", "13.7062347", "past");
    //     $dates = ["2019-12-09", "2019-12-08"];
    //     $res = $controller->getResult("currently", "past", $result, $dates);
    //
    //     $this->assertIsArray($res);
    // }


    /**
     * Test the function "getResult" when $info = "all" and $period = "toCome".
     */
    public function testGetResultAllToCome()
    {
        $controller = new CheckWeather();
        $result = $controller->getWeather("56.1619112", "13.7062347", "toCome");
        $dates = ["2019-12-10"];
        $res = $controller->getResultToCome("all", $result, $dates);

        $this->assertIsArray($res);
    }


    /**
     * Test the function "getResult" when $info = "all" and $period = "past".
     */
    // public function testGetResultAllPast()
    // {
    //     $controller = new CheckWeather();
    //     $result = $controller->getWeather("56.1619112", "13.7062347", "past");
    //     $dates = ["2019-12-09", "2019-12-08"];
    //     $res = $controller->getResult("all", "past", $result, $dates);
    //
    //     $this->assertIsArray($res);
    // }


    /**
     * Test the function "getResult" when $info is not "all" and $period = "toCome".
     */
    public function testGetResultToCome()
    {
        $controller = new CheckWeather();
        // $result = $controller->getWeather("56.1619112", "13.7062347", "toCome");

        // Output from weather prognosis
        $wOutput = require(ANAX_INSTALL_PATH . "/config/weather_example_all.php");
        $result = $wOutput["weather_all_to_come"];
        // $dates = ["2019-12-10"];

        $res = $controller->getResultToCome("currently", $result);
        $this->assertIsArray($res);

        $res = $controller->getResultToCome("hourly", $result);
        $this->assertIsArray($res);

        $res = $controller->getResultToCome("daily", $result);
        $this->assertIsArray($res);
    }


    /**
     * Test the function "getResult" when $info = "daily" and $period = "past".
     */
    // public function testGetResultDailyPast()
    // {
    //     $controller = new CheckWeather();
    //     $result = $controller->getWeather("56.1619112", "13.7062347", "past");
    //     $dates = ["2019-12-09", "2019-12-08"];
    //     $res = $controller->getResult("daily", "past", $result, $dates);
    //
    //     $this->assertIsArray($res);
    // }


    /**
     * Test the function "getWeather".
     */
    public function testGetWeather()
    {
        $controller = new CheckWeather();
        $res = $controller->getWeather("56.1619112", "13.7062347", "toCome");

        $this->assertIsArray($res);
    }
}
