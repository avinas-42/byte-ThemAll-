<?php

namespace GraphAware\NeoClient\Formatter\Tests\Unit;

use GuzzleHttp\Psr7\Response as HttpResponse;
use GraphAware\NeoClient\Formatter\Response;

/**
 * Class ResponseTest
 * @package GraphAware\NeoClient\Formatter\Tests\Unit
 *
 * @group response
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \GraphAware\NeoClient\Formatter\Response
     */
    protected $response;

    public function setUp()
    {
        $this->response = new Response($this->loadResponse(__DIR__.'/../_resources/response-profile.json'));
    }

    public function testConstruction()
    {
        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $this->response->getHttpResponse());
        $this->assertEmpty($this->response->getResults());
    }

    public function testResponseIsAnalysed()
    {
        $this->assertInternalType('array', $this->response->getBody());
        $this->assertFalse($this->response->hasError());
    }

    public function testResponseWithError()
    {
        $response = new Response($this->loadResponse(__DIR__.'/../_resources/response-with-fail.json'));
        $this->assertTrue($response->hasError());
        $this->assertInstanceOf('GraphAware\NeoClient\Formatter\Neo4jError', $response->getError());
    }

    public function testGetResultWillReturnNullWhenNoResultsArePresent()
    {
        $this->assertNull($this->response->getSingleResultOrNull());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionIsThrownWhenNoResultsButExpected()
    {
        $response = new Response($this->loadResponse(__DIR__.'/../_resources/response-with-fail.json'));
        $response->getSingleResult();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionIsThrownWhenCallingSingleResultButMoreResultsArePresent()
    {
        $response = new Response($this->loadResponse(__DIR__.'/../_resources/response-profile.json'));
        $response->getSingleResult();
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