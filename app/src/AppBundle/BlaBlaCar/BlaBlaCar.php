<?php

namespace AppBundle\BlaBlaCar;

/**
 * Map the vendor items to their correct families.
 */
class BlaBlaCar
{
    const API_KEY = 'd2e8f2eb4e0f4bca8cb318177a22dfbc';
    /**
     * @var string[]
     */
    public $fn = 'Paris';

    public $data = null;

    /**
     * @return string[]
     */
    public function __construct()
    {
        $this->url = 'https://public-api.blablacar.com/api/v2/trips?key='.API_KEY.'&fn=Paris';
        $this->data = null;
    }

    /**
     *
     * @throws \Exception
     */
    private function getData()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // set url
        curl_setopt($ch, CURLOPT_URL, $this->url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $jsonOutput = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        $output = json_decode($jsonOutput);

        $this->data = $output;
    }

    public function getTrips()
    {
        $this->getData();
        return $this->data->trips;
    }
}
