<?php

/**
 * This file is part of the GraphAware NeoClient package.
 *
 * (c) GraphAware <http://graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\NeoClient\Formatter\Query;

class Statement
{
    /**
     * @var string
     */
    protected $query;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var null|string
     */
    protected $tag;

    /**
     * @var array
     */
    protected $resultDataFormat;

    public function __construct($query, array $parameters = array(), array $resultDataFormat, $tag = null)
    {
        $this->query = trim((string) $query);
        $this->parameters = $parameters;
        $this->tag = null !== $tag ? trim((string) $tag) : null;
        $this->resultDataFormat = $resultDataFormat;
    }

    /**
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @return null|string
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * @return bool
     */
    public function hasTag()
    {
        return null !== $this->tag;
    }

    /**
     * @return array
     */
    public function getResultDataFormat()
    {
        return $this->resultDataFormat;
    }

    public function toArray()
    {
        return [
            'query' => $this->query,
            'params' => $this->parameters,
            'resultDataFormat' => $this->resultDataFormat
        ];
    }
}