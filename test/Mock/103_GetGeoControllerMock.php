<?php
namespace Anax\Models;

use Anax\Models\GetGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class GetGeoControllerMock extends GetGeo
{
    /**
    * Class for mocking the results from ipgeo
    *
    */
    public function getGeoController($ip)
    {
        $controller = new GetGeoMock();
        $data = $controller->getGeoMock($ip);
        return $data;
    }
}
