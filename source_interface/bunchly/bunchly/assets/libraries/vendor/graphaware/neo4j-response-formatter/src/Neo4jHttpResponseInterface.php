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

interface Neo4jHttpResponseInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response);

    /**
     * @return mixed
     */
    public function hasError();

    /**
     * @return mixed
     */
    public function getError();

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @return mixed
     */
    public function getHttpResponse();
}