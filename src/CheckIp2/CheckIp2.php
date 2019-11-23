<?php

namespace Anax\CheckIp2;

class CheckIp2
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
        // $userIp = "127.0.0.1";
        //
        // if (getenv("REMOTE_ADDR")) {
        //     $userIp = getenv("REMOTE_ADDR");
        // }

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
    public function getCurl()
    {
        // Set API access key
        $accessKey = implode("", require(ANAX_INSTALL_PATH . "/config/api_key.php"));

        // Initialize CURL
        $chandle = curl_init('http://api.ipstack.com/'.$this->ipadr.'?access_key='.$accessKey.'');
        curl_setopt($chandle, CURLOPT_RETURNTRANSFER, true);

        // Store the data
        $json = curl_exec($chandle);
        curl_close($chandle);

        // Decode JSON response
        $apiResult = json_decode($json, true);

        return $apiResult;
    }
}
