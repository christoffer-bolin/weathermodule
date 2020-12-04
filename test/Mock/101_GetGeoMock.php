<?php
namespace Anax\Models;

/**
 * Class for mocking IpGeo
 * Class only contain methods for checking
 *
 */
class GetGeoMock extends GetGeo
{
    /**
    * Class for mocking request to IPstack
    *
    */
    public function getGeo($ip = "85.24.145.234")
    {
        $data = [
            "country" => "Sweden",
            "city" => "Karlskrona",
            "latitude" => "56.16280",
            "longitude" => "15.58697",
        ];

        return $data;
    }
}
