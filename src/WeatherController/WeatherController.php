<?php

namespace Anax\WeatherController;

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
class WeatherController implements ContainerInjectableInterface
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
        $this->di->set("dates", "\Anax\WeatherController\Dates");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexActionGet() : object
    {
        // Add content as a view and then render the page.
        $title = "Kolla väder";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $getAddr = $request->getServer("REMOTE_ADDR");

        $page->add("check-weather/start");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * Get request data and check if
     * data is a valid ip address.
     * POST mountpoint/
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $title = "Kolla ip";

        $request = $this->di->request;
        $page = $this->di->get("page");

        // Get content from submit.
        $place = $request->getPost("check");
        $period = $request->getPost("check1");
        $lat = "";
        $long = "";

        $dates = $this->di->get("dates")->getPastDates(30);

        $apiReq = new CheckWeather();

        // check if input is latitude and longitude,
        // otherwise fetch latitude and longitude from ip address
        if (strpos($place, ",")) {
            $places = explode(",", $place);
            $lat = trim($places[0]);
            $long = trim($places[1]);
        } else {
            $apiReq->setIp($place);
            $apiResult = $apiReq->getLocation();
            if ($apiResult["type"] == null) {
                $page->add("check-weather/end-error");

                return $page->render([
                    "title" => $title,
                ]);
            }
            $lat = $apiResult["latitude"];
            $long = $apiResult["longitude"];
        }

        $result = $apiReq->getWeather($lat, $long, $period);

        if ($period == "toCome") {
            $sum = $result["daily"]["summary"];
        } else {
            $sum = "";
            $count = 0;
            foreach($result as $res) {
                $sum .= $dates[$count] . ": " . $res["hourly"]["summary"] . "<br>";
                $count += 1;
            }
        }

        $data = [
            "res" => $result,
            "sum" => $sum,
            "lat" => $lat,
            "long" => $long
        ];

        $page->add("check-weather/end", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
