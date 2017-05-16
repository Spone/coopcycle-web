<?php

namespace AppBundle\Utils;

use AppBundle\Utils\TimeRange;

class TimeRangeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsOpen()
    {
        $timeRange = new TimeRange('Mo-Sa 11:45-14:45');

        // Monday
        $this->assertTrue($timeRange->isOpen(new \DateTime('2017-05-15 12:30')));
        $this->assertFalse($timeRange->isOpen(new \DateTime('2017-05-15 11:25')));

        // Tuesday
        $this->assertTrue($timeRange->isOpen(new \DateTime('2017-05-16 13:30')));
        $this->assertFalse($timeRange->isOpen(new \DateTime('2017-05-16 15:30')));

        // Wednesday
        $this->assertTrue($timeRange->isOpen(new \DateTime('2017-05-17 13:45')));
        $this->assertFalse($timeRange->isOpen(new \DateTime('2017-05-17 19:30')));

        // Sunday
        $this->assertFalse($timeRange->isOpen(new \DateTime('2017-05-21 12:30')));
    }

    public function testGetNextOpeningDate()
    {
        $timeRange = new TimeRange('Mo-Sa 11:45-14:45');

        $this->assertEquals(new \DateTime('2017-05-16 11:45'), $timeRange->getNextOpeningDate(new \DateTime('2017-05-16 06:30')));
        $this->assertEquals(new \DateTime('2017-05-17 11:45'), $timeRange->getNextOpeningDate(new \DateTime('2017-05-16 15:30')));
    }
}
