<?php

namespace Anax\Controller;

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
class CheckIpController implements ContainerInjectableInterface
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

        $data = [
            "title" => $title,
        ];

        $page->add("check-ip/start", $data);

        return $page->render();
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

        $doCheck = "";
        $host = "";

        // Get content from submit.
        $ipadr = $request->getPost("check");

        if (filter_var($ipadr, FILTER_VALIDATE_IP)) {
            $doCheck = "Detta är en giltig IP-adress.";
            $host = gethostbyaddr($ipadr);
            $class = "valid";
            // echo("$ipadr is a valid IP address");
        } else {
            $doCheck = "Detta är en ogiltig IP-adress.";
            $class = "invalid";
            $host = "ingen";
            // echo("$ipadr is not a valid IP address");
        }

        $data = [
            "title" => $title,
            "ip" => $ipadr,
            "result" => $doCheck,
            "domain" => $host,
            "class" => $class
        ];

        // $_SESSION["ip"] = $doCheck;
        $page->add("check-ip/end", $data);

        return $page->render();
    }
}
