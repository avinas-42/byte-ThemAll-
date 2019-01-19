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

class ResponseFormattingService
{
    /**
     * @var \GraphAware\NeoClient\Formatter\ResultFormatter
     */
    protected $resultFormatter;

    /**
     *
     */
    public function __construct()
    {
        $this->resultFormatter = new ResultFormatter();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $httpResponse
     * @return \GraphAware\NeoClient\Formatter\Response
     */
    public function formatResponse(ResponseInterface $httpResponse)
    {
        $response = new Response($httpResponse);
        if (!$response->hasError()) {
            $body = $response->getBody();
            if (isset($body['results']) && is_array($body['results'])) {
                foreach ($body['results'] as $queryResult) {
                    if (isset($queryResult['data'][0])) {
                        $result = $this->resultFormatter->formatResult($queryResult);
                        $response->addResult($result);
                    }
                }
            }
        }

        return $response;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\ResultFormatter
     */
    public function getResultFormatter()
    {
        return $this->resultFormatter;
    }
}