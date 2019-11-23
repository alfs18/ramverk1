<?php

namespace Anax\CheckIp2;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the CheckIpController2.
 */
class CheckIpController2Test extends TestCase
{
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $controller = new CheckIpController2();
        $controller->initialize();
        $res = $controller->indexAction();
        $this->assertContains("db is active", $res);
    }


    /**
     * Test the route "page" GET.
     */
    public function testPageActionGet()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new CheckIpController2();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $res = $controller->pageActionGet();
        $this->assertIsObject($res);
        // $this->assertInstanceOf("Anax\Response\Response", $res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);

        // Check that the body contains some known word
        $body = $res->getBody();
        // var_dump($body);
        $this->assertContains("Skriv in en ip-adress för att kolla om den är gilig.", $body);
    }


    /**
     * Test the route "page" POST when ip is valid.
     */
    public function testPageActionPostValid()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new CheckIpController2();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $controller->pageActionGet();
        $_POST["check"] = "172.217.11.14";
        $res = $controller->pageActionPost();

        $this->assertIsObject($res);
    }


    /**
     * Test the route "page" POST when ip is invalid.
     */
    public function testPageActionPostInvalid()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new CheckIpController2();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $controller->pageActionGet();
        $_POST["check"] = "172.217.11.";
        $res = $controller->pageActionPost();

        $this->assertIsObject($res);
    }
}
