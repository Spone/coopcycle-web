<?php

namespace AppBundle\Utils;

use AppBundle\Utils\GeoUtils;
use AppBundle\Entity\GeoCoordinates;

class GeoUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testAsGeoCoordinates()
    {
        $text = 'POINT(48.877821 2.3706188)';

        $geo = GeoUtils::asGeoCoordinates($text);

        $this->assertEquals(48.877821, $geo->getLatitude());
        $this->assertEquals(2.3706188, $geo->getLongitude());
    }

    public function testAsPoint()
    {
        $geo = new GeoCoordinates(48.877821, 2.3706188);

        $this->assertEquals('POINT(48.877821 2.3706188)', GeoUtils::asPoint($geo));
    }
}
