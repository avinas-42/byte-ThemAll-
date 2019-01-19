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

class RelationshipsCollection extends Collection
{
    /**
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship $relationship
     */
    public function addRelationship(Relationship $relationship)
    {
        $this->addElement($relationship, $relationship->getId());
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getRelationships()
    {
        return $this->elements;
    }

    /**
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship $relationship
     * @return bool
     */
    public function hasRelationship(Relationship $relationship)
    {
        return $this->hasElement($relationship);
    }

    /**
     * @param $id
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship
     */
    public function getRelationship($id)
    {
        return $this->getElement($id);
    }
}