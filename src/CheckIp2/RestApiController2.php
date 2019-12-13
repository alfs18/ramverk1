<?php

namespace Anax\CheckIp2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RestApiController2 implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }


    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/json
     *
     * @return object
     */
    public function jsonActionGet() : object
    {
        $page = $this->di->get("page");
        $title = "Info om ip";
        $request = $this->di->get("request");

        $ipCheck = new CheckIp2();
        $userIp = $ipCheck->getUserIp($request->getServer("REMOTE_ADDR"));

        $data = [
            "userIp" => $userIp
        ];

        $page->add("rest-api/start2", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/json
     *
     * @return array
     */
    public function jsonActionPost() : array
    {
        // $title = "Info om ip";

        $request = $this->di->request;
        // $page = $this->di->get("page");

        // Get content from submit.
        $ipadr = $request->getPost("check");

        // Set IP address and get content from curl request.
        $apiReq = new CheckIp2();
        $apiReq->setIp($ipadr);
        $apiResult = $apiReq->getCurl();

        return [$apiResult];
    }


    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/json
     *
     * @return object
     */
    public function exampleOneActionGet() : object
    {
        $page = $this->di->get("page");
        $title = "Info om ip";

        // Get content from submit.
        $ipadr = "172.217.11.23";

        // Set IP address and get content from curl request.
        $apiReq = new CheckIp2();
        $apiReq->setIp($ipadr);
        $apiResult = $apiReq->getCurl();

        $data = [
            "result" => json_encode($apiResult, JSON_PRETTY_PRINT) . "\n",
        ];

        $page->add("rest-api/ex3", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/json
     *
     * @return object
     */
    public function exampleTwoActionGet() : object
    {
        $page = $this->di->get("page");
        $title = "Info om ip";

        $ipadr = "192.168.0.1";

        // Set IP address and get content from curl request.
        $apiReq = new CheckIp2();
        $apiReq->setIp($ipadr);
        $apiResult = $apiReq->getCurl();

        $data = [
            "result" => json_encode($apiResult, JSON_PRETTY_PRINT) . "\n",
        ];

        $page->add("rest-api/ex3", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
