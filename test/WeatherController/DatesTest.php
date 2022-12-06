<?php

namespace Anax\WeatherController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the WeatherController.
 */
class DatesTest extends TestCase
{
    /**
     * Test the function "getPastDays"
     */
    public function testGetPastDates()
    {
        $controller = new Dates();
        $res = $controller->getPastDates(5);

        $this->assertIsArray($res);
    }
}
