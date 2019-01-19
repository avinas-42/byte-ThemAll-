<?php

/**
 * This file is part of the GraphAware NeoClient package.
 *
 * (c) GraphAware <http://graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\NeoClient\Formatter;

use Psr\Http\Message\ResponseInterface;

class Response implements Neo4jHttpResponseInterface
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $httpResponse;

    /**
     * @var array
     */
    protected $body;

    /**
     * @var null|array
     */
    protected $error;

    /**
     * @var \GraphAware\NeoClient\Formatter\Result[]
     */
    protected $results = [];

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->httpResponse = $response;
        $this->deserializeBody();
        $this->checkErrors();
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * @param \GraphAware\NeoClient\Formatter\Result $result
     * @param null $key
     */
    public function addResult(Result $result, $key = null)
    {
        $this->results[] = $result;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Result[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @deprecated will be removed in 4.0
     */
    public function getResult()
    {
        if (isset($this->results[0])) {
            return $this->results[0];
        }

        return null;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Result
     */
    public function getSingleResult()
    {
        if (empty($this->results)) {
            throw new \RuntimeException('The Response contains no results');
        }

        return $this->results[0];
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Result|null
     */
    public function getSingleResultOrNull()
    {
        $this->throwExceptionIfMoreThanXResult();

        if (isset($this->results[0])) {
            return $this->results[0];
        }

        return null;
    }

    /**
     * @return int
     */
    public function getResultsCount()
    {
        return count($this->results);
    }

    /**
     * @param int $x
     */
    public function throwExceptionIfMoreThanXResult($x = 1)
    {
        if (count($this->results) > $x) {
            throw new \RuntimeException('The Response contains more than one result');
        }
    }

    /**
     * @return null|array
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function hasError()
    {
        return null !== $this->error;
    }

    /**
     * @return bool
     */
    public function checkErrors()
    {
        if (isset($this->body['errors']) && !empty($this->body['errors'])) {
            $error = $this->body['errors'][0];
            $this->error = new Neo4jError($error['code'], $error['message']);

            return true;
        }

        return false;
    }

    /**
     *
     */
    public function deserializeBody()
    {
        $this->body = json_decode((string) $this->httpResponse->getBody(), true);
    }
}