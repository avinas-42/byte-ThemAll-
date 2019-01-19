<?php

namespace GraphAware\NeoClient\Formatter\Tests\Integration;

use GraphAware\NeoClient\Formatter\ResponseFormattingService;
use GuzzleHttp\Psr7\Response as HttpResponse;
use Neoxygen\NeoClient\ClientBuilder;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testNeoClientIntegration()
    {
        $client = ClientBuilder::create()
          ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'veryCoolMax')
          ->setAutoFormatResponse(true)
          ->setResponseFormatterClass('GraphAware\NeoClient\Formatter\Adapter')
          ->enableNewFormattingService()
          ->build();

        $response = $client->sendCypherQuery('MATCH (n) RETURN count(n) as nodesCount');

        $this->assertInstanceOf('GraphAware\NeoClient\Formatter\Response', $response);

    }

    public function testResponseIsFormatted()
    {
        $service = new ResponseFormattingService();
        $httpresponse = $this->loadResponse(__DIR__.'/../_resources/response-profile.json');
        $response = $service->formatResponse($httpresponse);

        $this->assertInstanceOf('GraphAware\NeoClient\Formatter\Response', $response);
    }

    /**
     * @param $file
     * @return \GuzzleHttp\Psr7\Response
     */
    private function loadResponse($file)
    {
        $body = file_get_contents($file);
        $httpResponse = new HttpResponse(200, array(), $body);

        return $httpResponse;
    }
}