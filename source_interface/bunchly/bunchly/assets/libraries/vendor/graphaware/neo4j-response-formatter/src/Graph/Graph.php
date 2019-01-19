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

class Graph
{
    protected $nodes;

    protected $relationships;

    public function __construct(NodesCollection $nodes, RelationshipsCollection $relationships)
    {
        $this->nodes = $nodes;
        $this->relationships = $relationships;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\NodesCollection
     */
    public function getNodesCollection()
    {
        return $this->nodes;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\RelationshipsCollection
     */
    public function getRelationshipsCollection()
    {
        return $this->relationships;
    }


}