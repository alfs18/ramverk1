<?php

namespace Anax\WeatherController;

class CheckWeather
{
    private $ipadr;

    /**
     * Get user IP address if it exists,
     * otherwise get default address
     *
     * @param string the user's IP address
     * @return string the user's IP address
     */
    public function getUserIp($req)
    {
        // if user's IP address is available,
        // set $userIp to that address,
        // if not, set a default IP address
        $userIp = $req ?? "127.0.0.1";

        return $userIp;
    }


    /**
     * Set IP address
     *
     * @param string the IP address
     */
    public function setIp($ipt)
    {
        $this->ipadr = $ipt;
    }


    /**
     * Sets API access key
     * Do a curl request
     * @return array the curl response
     */
    public function getLocation()
    {
        // Set API access key
        $accessKey = require(ANAX_INSTALL_PATH . "/config/api_key.php");

        // Initialize CURL
        $chandle = curl_init('http://api.ipstack.com/'.$this->ipadr.'?access_key='.$accessKey["api_key"].'');
        curl_setopt($chandle, CURLOPT_RETURNTRANSFER, true);

        // Store the data
        $json = curl_exec($chandle);
        curl_close($chandle);

        // Decode JSON response
        $apiResult = json_decode($json, true);

        return $apiResult;
    }


    /**
     * @param integer days
     * @return array all the dates
     */
    public function getPastDays($days) {
        $dates = [];
        for ($x = 1; $x <= $days; $x++) {
            $d=strtotime("-$x Days");
            $date = date("Y-m-d", $d);
            $dates[] = $date;
        }
        return $dates;
    }


    /**
     * @param string $info either all, current, hourly or daily
     * @param string $period either toCome or past
     * @param string $result the curl response
     * @param integer $dates all dates to be shown
     * @return array $sum the chosen summary
     */
    public function getResult($info, $period, $result, $dates) {
        if ($info == "all") {
            if ($period == "toCome") {
                $sum = $result;

                // $current = "Currently: " . $result["currently"]["summary"];
                // $hour = ",<br>Hourly: " . $result["hourly"]["summary"];
                // $day = ",<br>Daily: " . $result["daily"]["summary"];
                // $sum = $current . $hour . $day;
            } else {
                $sum = [];
                $count = 0;
                foreach($result as $res) {
                    // $current = ": <br>Currently: " . $res["currently"]["summary"];
                    // $hour = "<br>Hourly: " . $res["hourly"]["summary"];
                    // $day = "<br>Daily: " . $res["daily"]["data"][0]["summary"];

                    // $sum .= $dates[$count] . $current . $hour . $day . "<br><br>";

                    // $sum[] = $dates[$count] . $current . $hour . $day . "<br><br>";
                    $sum[$dates[$count]]['currently'] = $res["currently"]["summary"];
                    $sum[$dates[$count]]['hourly'] = $res["hourly"]["summary"];
                    $sum[$dates[$count]]['daily'] = $res["daily"]["data"][0]["summary"];

                    $count += 1;
                }
            }
        } else {
            if ($period == "toCome") {
                if ($info == "currently") {
                    $sum[$info] = $result[$info];
                    $d = $result[$info]['time'];
                    $sum[$info]['time'] = date("Y-m-d H:i:s", $d);
                } else {
                    $sum[$info]['summary'] = $result[$info]["summary"];
                    $sum[$info]['data'] = $result[$info]["data"];
                    $count = 0;
                    foreach ($result[$info]["data"] as $res) {
                        $d = $res['time'];
                        $sum[$info]['data'][$count]['time'] = date("Y-m-d H:i:s", $d);
                        if ($info == "daily") {
                            $d = $res['sunriseTime'];
                            $sum[$info]['data'][$count]['sunriseTime'] = date("Y-m-d H:i:s", $d);
                            $d = $res['sunsetTime'];
                            $sum[$info]['data'][$count]['sunsetTime'] = date("Y-m-d H:i:s", $d);
                        }
                        $count += 1;
                    }
                }
            } else {
                $sum = [];
                $count = 0;
                foreach($result as $res) {
                    if ($info == "daily") {
                        // $sum .= $dates[$count] . ": " . $res[$info]["data"][0]["summary"]  . "<br>";
                        $sum[$dates[$count]][$info] = $res[$info]["data"][0]["summary"];
                    } elseif ($info == "currently") {
                        $sum[$dates[$count]][$info] = $res[$info]["summary"];
                    } else {
                        // $sum .= $dates[$count] . ": " . $res[$info]["summary"] . "<br>";
                        $sum[$dates[$count]][$info]['summary'] = $res[$info]["summary"];
                        $data = [];
                        foreach ($res[$info]['data'] as $ans) {
                            $sum[$dates[$count]][$info]['data']['summary'] = $ans["summary"];
                            $sum[$dates[$count]][$info]['data']['temperature'] = $ans["temperature"] . "&deg;C";
                        }
                        // $sum[$dates[$count]][$info]['data'] = $data;
                    }
                    $count += 1;
                }
            }
        }

        return $sum;
    }


    /**
     * Sets API access key
     * Do a curl request
     * @param string $latitude
     * @param string $longitude
     * @param string $period either toCome or past
     * @return array the curl response
     */
    public function getWeather($latitude, $longitude, $period)
    {
        // Set API access key
        $accessKey = require(ANAX_INSTALL_PATH . "/config/api_key.php");

        // Initialize CURL
        $url = 'https://api.darksky.net/forecast/'.$accessKey["weather_api_key"].'/'.$latitude.','.$longitude;

        if ($period == "toCome") {
            $chandle = curl_init("$url?units=si");
            curl_setopt($chandle, CURLOPT_RETURNTRANSFER, true);

            // Store the data
            $json = curl_exec($chandle);
            curl_close($chandle);

            // Decode JSON response
            $apiResult = json_decode($json, true);

            return $apiResult;
        }

        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Get dates and time
        $dates = $this->getPastDays(30);
        $time = date("H:i:s");

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $mh = curl_multi_init();
        $chAll = [];    // gör den för att senare kunna döda den
        foreach ($dates as $date) {
            $ch = curl_init("$url,$date"."T$time?units=si");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete.
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        // Close the handles
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }

        return $response;
    }
}
