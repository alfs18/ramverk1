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
class CheckIpController2 implements ContainerInjectableInterface
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
     * Allow user to check if input is a valid ip address.
     * GET mountpoint/page
     *
     * @return object
     */
    public function pageActionGet() : object
    {
        // Add content as a view and then render the page.
        $page = $this->di->get("page");
        $title = "Kolla ip";
        $request = $this->di->get("request");
        $getAddr = $request->getServer("REMOTE_ADDR");

        $ipCheck = new CheckIp2();
        $userIp = $ipCheck->getUserIp($getAddr);

        $data = [
            "userIp" => $userIp
        ];

        $page->add("check-ip/start2", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Get request data and check if
     * data is a valid ip address.
     * POST mountpoint/page
     *
     * @return object
     */
    public function pageActionPost() : object
    {
        $title = "Kolla ip";

        $request = $this->di->request;
        $page = $this->di->get("page");

        // Get content from submit.
        $ipadr = $request->getPost("check");

        // Set IP address and get content from curl request.
        $apiReq = new CheckIp2();
        $apiReq->setIp($ipadr);
        $apiResult = $apiReq->getCurl();

        $data = [
            "res" => $apiResult
        ];

        $page->add("check-ip/end2", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
