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
class RestWeatherController implements ContainerInjectableInterface
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
    public function initialize(): void
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
    public function indexActionGet(): object
    {
        // Add content as a view and then render the page.
        $title = "Kolla väder";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        // $getAddr = $request->getServer("REMOTE_ADDR");

        $ipCheck = new CheckWeather();
        $userIp = $ipCheck->getUserIp($request->getServer("REMOTE_ADDR"));

        $data = [
            "userIp" => $userIp,
        ];

        $page->add("rest-weather/start", $data);

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
    public function indexActionPost(): object
    {
        $title = "Kolla ip";

        $request = $this->di->request;
        $page = $this->di->get("page");

        // Get content from submit.
        $place = $request->getPost("check");
        $period = $request->getPost("check1");
        $info = $request->getPost("check2");
        $lat = "";
        $long = "";
        $sum;

        // $dates = $this->di->get("dates")->getPastDates(30);

        $apiReq = new CheckWeather();

        // check if input is latitude and longitude,
        // otherwise fetch latitude and longitude from ip address
        // var_dump("hello");
        // var_dump($place);
        // var_dump(strpos($place, ":"));
        if (strpos($place, ",") != false) {
            // var_dump("yes");
            $places = explode(",", $place);
            $lat = trim($places[0]);
            $long = trim($places[1]);
        } else {
            // var_dump("no");
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
            $sum = $apiReq->getResultToCome($info, $result);
        } else {
            $dates = $this->di->get("dates")->getPastDates(30);
            $sum = $apiReq->getResultPast($info, $result, $dates);
        }

        $data = [
            "res" => $result,
            "result" => json_encode($sum, JSON_PRETTY_PRINT) . "\n",
            // "a" => $period,
            // "b" => $info,
            "lat" => $lat,
            "long" => $long
        ];

        $page->add("rest-weather/end", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Example output from weather forecast
     *
     * @return string
     */
    public function example1ActionGet(): object
    {
        // Add content as a view and then render the page.
        $title = "Ex.1: Kolla väder";
        $page = $this->di->get("page");
        // $request = $this->di->get("request");

        $result = "hello";
        // Output from weather prognosis
        $wOutput = require(ANAX_INSTALL_PATH . "/config/weather_example_all.php");
        $sum = $wOutput["weather_all_to_come"];
        $lat = "42.3601";
        $long = "-71.0589";


        $data = [
            "res" => $result,
            "sum" => json_encode($sum, JSON_PRETTY_PRINT) . "\n",
            "lat" => $lat,
            "long" => $long
        ];

        $page->add("check-weather/end", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * Example output from weather forecast
     *
     * @return string
     */
    public function example2ActionGet(): object
    {
        // Add content as a view and then render the page.
        $title = "Ex.2: Kolla väder";
        $page = $this->di->get("page");
        // $request = $this->di->get("request");

        // Output from weather prognosis
        // $wOutput = require(ANAX_INSTALL_PATH . "/config/weather_example_all.php");
        // $sum = $wOutput["weather_all_to_come"];
        $lat = "42.3601";
        $long = "-71.0589";
        // $period = "past";

        // $apiReq = new CheckWeather();
        // $sum = $apiReq->getWeather($lat, $long, $period);

        // Output from weather prognosis
        $wOutput = require(ANAX_INSTALL_PATH . "/config/weather_example_all.php");
        $sum = $wOutput["weather_all_past"];

        $data = [
            "res" => $sum,
            "sum" => json_encode($sum, JSON_PRETTY_PRINT) . "\n",
            "lat" => $lat,
            "long" => $long
        ];

        $page->add("check-weather/end", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
