<?php

namespace Anax\CheckIp2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the CheckIp2.
 */
class CheckIp2Test extends TestCase
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
        $controller = new CheckIp2();
        $res = $controller->getUserIp($di->get("request")->getServer("REMOTE_ADDR"));
        // var_dump($res);

        $this->assertIsString($res);
    }

    /**
     * Test the function "setIp".
     */
    public function testSetIp()
    {
        $controller = new CheckIp2();
        $res = $controller->setIp("172.217.11.23");

        $this->assertNull($res);
    }

    /**
     * Test the function "getCurl".
     */
    public function testGetCurl()
    {
        $controller = new CheckIp2();
        $controller->setIp("172.217.11.23");
        $res = $controller->getCurl();

        $this->assertIsArray($res);
    }
}
