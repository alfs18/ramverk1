<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the RestApiController.
 */
class RestApiControllerTest extends TestCase
{
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $controller = new RestApiController();
        $controller->initialize();
        $res = $controller->indexAction();
        $this->assertContains("db is active", $res);
    }



    /**
     * Test the route "json" GET.
     */
    public function testJsonActionGet()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new RestApiController();
        $controller->setDI($di);
        $controller->initialize();

        // Test the container action
        $res = $controller->jsonActionGet();
        $this->assertIsObject($res);
        // var_dump($res);
        // $this->assertArrayHasKey("title", $res[0]);
        // $this->assertContains("Info om ip", $res[0]["title"]);
        // $this->assertArrayHasKey("di", $res[0]);
        // $this->assertContains("configuration", $res[0]["di"]);
        // $this->assertContains("request", $res[0]["di"]);
        // $this->assertContains("response", $res[0]["di"]);
    }



    /**
     * Test the route "json" POST.
     * Post valid ip-address.
     */
    public function testJsonActionPostValid()
    {
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new RestApiController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $controller->jsonActionGet();
        $_POST["check"] = "172.217.11.14";
        $res = $controller->jsonActionPost();
        $this->assertIsArray($res);

        // $this->assertInstanceOf("Anax\Response\Response", $res);
        // $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        //
        // // Check that the body contains some known word
        // $body = $res->getBody();
        // // var_dump($body);
        // $this->assertContains("HELLO", $body);
    }


    /**
     * Test the route "json" POST.
     * Post invalid ip-address.
     */
    public function testJsonActionPostInvalid()
    {
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new RestApiController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $controller->jsonActionGet();
        $_POST["check"] = "172.217.11.";
        $res = $controller->jsonActionPost();
        $this->assertIsArray($res);
    }

    /**
     * Test the route "exampleOne".
     */
    public function testExampleOneActionGet()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new RestApiController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $res = $controller->exampleOneActionGet();
        $this->assertIsObject($res);

        // Check that the body contains some known word
        $body = $res->getBody();
        $this->assertContains("Kolla ip", $body);
    }


    /**
     * Test the route "exampleTwo".
     */
    public function testExampleTwoActionGet()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new RestApiController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $res = $controller->exampleTwoActionGet();
        $this->assertIsObject($res);

        // Check that the body contains some known word
        $body = $res->getBody();
        $this->assertContains("Kolla ip", $body);
    }
}
