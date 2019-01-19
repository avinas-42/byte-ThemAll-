<?php

namespace GraphAware\NeoClient\Formatter\Tests\Unit;

use GraphAware\NeoClient\Formatter\ResponseFormattingService;

class ResponseFormattingServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $service = new ResponseFormattingService();
        $this->assertInstanceOf('GraphAware\NeoClient\Formatter\ResponseFormattingService', $service);
    }

    public function testResultFormatterIsInstantiated()
    {
        $service = new ResponseFormattingService();
        $this->assertInstanceOf('GraphAware\NeoClient\Formatter\ResultFormatter', $service->getResultFormatter());
    }
}