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

class Node
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $labels;

    /**
     * @var array
     */
    protected $properties;

    /**
     * @var \GraphAware\NeoClient\Formatter\Graph\RelationshipsCollection
     */
    protected $relationships;

    /**
     * @param int $id
     * @param array $labels
     * @param array $properties
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship[] $relationships
     */
    public function __construct($id, array $labels, array $properties, RelationshipsCollection $relationshipsCollection = null)
    {
        $this->id = (int) $id;
        $this->labels = $labels;
        $this->properties = $properties;
        $this->relationships = $relationshipsCollection !== null ? $relationshipsCollection : new RelationshipsCollection();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getLabels() {
        return $this->labels;
    }

    public function hasLabel($label)
    {
        return in_array($label, $this->labels);
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

    /**
     * @param $key
     * @return bool
     */
    public function hasProperty($key)
    {
        return array_key_exists($key, $this->properties);
    }

    /**
     * @param null|string $type
     * @param null|string $direction
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getRelationships($type = null, $direction = null) {
        $relationships = $this->relationships->getRelationships();
        if (null !== $type) {
            $relationships = $this->filterRelationshipsByType($type, $relationships);
        }
        if (null !== $direction) {
            $relationships = $this->filterRelationshipByDirection($direction, $relationships);
        }

        return $relationships;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getOutgoingRelationships()
    {
        $rels = [];
        foreach ($this->getRelationships() as $relationship) {
            if ($relationship->getStartNode()->getId() === $this->getId()) {
                $rels[] = $relationship;
            }
        }

        return $rels;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getIncomingRelationships()
    {
        $rels = [];
        foreach ($this->getRelationships() as $relationship) {
            if ($relationship->getEndNode()->getId() === $this->getId()) {
                $rels[] = $relationship;
            }
        }

        return $rels;
    }

    /**
     * @param $type
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getRelationshipsByType($type)
    {
        $rels = [];
        foreach ($this->getRelationships() as $relationship) {
            if ($relationship->getType() === $type) {
                $rels[] = $relationship;
            }
        }

        return $rels;
    }

    /**
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship $relationship
     */
    public function addRelationship(Relationship $relationship)
    {
        $this->relationships->addRelationship($relationship);
    }

    /**
     * @param string $direction
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship[] $relationships
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    private function filterRelationshipByDirection($direction, array $relationships)
    {
        $rels = [];
        foreach ($relationships as $relationship) {
            $included = false;
            switch ($direction) {
                case Relationship::DIRECTION_BOTH:
                    $included = true;
                    break;
                case Relationship::DIRECTION_INCOMING:
                    if ($relationship->getEndNode()->getId() === $this->getId()) {
                        $included = true;
                    }
                    break;
                case Relationship::DIRECTION_OUTGOING:
                    if ($relationship->getStartNode()->getId() === $this->getId()) {
                        $included = true;
                    }
                    break;
            }
            if ($included) {
                $rels[] = $relationship;
            }
        }

        return $rels;
    }

    /**
     * @param $type
     * @param \GraphAware\NeoClient\Formatter\Graph\Relationship $relationship[]
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship $relationship[]
     */
    private function filterRelationshipsByType($type, array $relationships)
    {
        $rels = [];
        foreach ($relationships as $relationship) {
            if ($relationship->getType() === $type) {
                $rels[] = $relationship;
            }
        }

        return $rels;
    }


}