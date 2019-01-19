<?php

/**
 * This file is part of the GraphAware NeoClient package.
 *
 * (c) GraphAware <http://graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\NeoClient\Formatter\Graph;

class Relationship
{
    const DIRECTION_INCOMING = 'INCOMING';

    const DIRECTION_OUTGOING = 'OUTGOING';

    const DIRECTION_BOTH = 'BOTH';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \GraphAware\NeoClient\Formatter\Graph\Node
     */
    protected $startNode;

    /**
     * @var \GraphAware\NeoClient\Formatter\Graph\Node
     */
    protected $endNode;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $properties;


    /**
     * @param int $id
     * @param \GraphAware\NeoClient\Formatter\Graph\Node $startNode
     * @param \GraphAware\NeoClient\Formatter\Graph\Node $endNode
     * @param string $type
     * @param array $properties
     */
    public function __construct($id, Node $startNode, Node $endNode, $type, array $properties = array())
    {
        $this->id = (int) $id;
        $this->startNode = $startNode;
        $this->endNode = $endNode;
        $this->type = (string) $type;
        $this->properties = $properties;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Node
     */
    public function getStartNode() {
        return $this->startNode;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Node
     */
    public function getEndNode() {
        return $this->endNode;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param $key
     * @return null|mixed
     */
    public function getProperty($key)
    {
        if (!array_key_exists($key, $this->properties)) {
            return null;
        }

        return $this->properties[$key];
    }


}