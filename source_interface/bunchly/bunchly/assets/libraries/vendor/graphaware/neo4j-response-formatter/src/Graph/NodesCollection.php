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

class NodesCollection extends Collection
{

    /**
     * @param \GraphAware\NeoClient\Formatter\Graph\Node $node
     */
    public function addNode(Node $node)
    {
        $this->addElement($node, $node->getId());
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Node[]
     */
    public function getNodes()
    {
        return $this->elements;
    }

    /**
     * @param \GraphAware\NeoClient\Formatter\Graph\Node $node
     * @return bool
     */
    public function hasNode(Node $node)
    {
        return $this->hasElement($node);
    }

    /**
     * @param $id
     * @return \GraphAware\NeoClient\Formatter\Graph\Node
     */
    public function getNode($id)
    {
        return $this->getElement($id);
    }
}