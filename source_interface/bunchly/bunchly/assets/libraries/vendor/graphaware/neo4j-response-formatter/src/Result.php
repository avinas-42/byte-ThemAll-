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

use GraphAware\NeoClient\Formatter\Graph\Graph;

class Result
{
    /**
     * @var \GraphAware\NeoClient\Formatter\Table
     */
    protected $tableFormat;

    /**
     * @var \GraphAware\NeoClient\Formatter\Graph\NodesCollection
     */
    protected $nodesCollection;

    /**
     * @var \GraphAware\NeoClient\Formatter\Graph\RelationshipsCollection
     */
    protected $relationshipsCollection;

    /**
     * @var array
     */
    private $identificationTable;

    /**
     * @var null|\GraphAware\NeoClient\Formatter\QueryPlan
     */
    protected $queryPlan;

    /**
     * @param \GraphAware\NeoClient\Formatter\Table $table
     * @param \GraphAware\NeoClient\Formatter\Graph\Graph $graph
     * @param array $identificationTable
     */
    public function __construct(Table $table, Graph $graph, array $identificationTable)
    {
        $this->tableFormat = $table;
        $this->nodesCollection = $graph->getNodesCollection();
        $this->relationshipsCollection = $graph->getRelationshipsCollection();
        $this->identificationTable = $identificationTable;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Table
     */
    public function getTableFormat()
    {
        return $this->tableFormat;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Node[]
     */
    public function getNodes()
    {
        return $this->nodesCollection->getNodes();
    }

    /**
     * @param $id
     * @return \GraphAware\NeoClient\Formatter\Graph\Node|null
     */
    public function getNodeById($id)
    {
        $id = (int) $id;
        foreach ($this->getNodes() as $node) {
            if ($node->getId() === $id) {
                return $node;
            }
        }

        return null;
    }

    /**
     * Returns a single node
     *
     * @return null|\GraphAware\NeoClient\Formatter\Graph\Node
     */
    public function getSingleNode()
    {
        if (count($this->nodesCollection->getNodes()) > 0) {
            return array_values($this->getNodes())[0];
        }

        return null;
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Graph\Relationship[]
     */
    public function getRelationships()
    {
        return $this->relationshipsCollection->getRelationships();
    }

    /**
     * @param string $key
     */
    public function get($key, $oneElementArraysAsSingleValue = false)
    {
        $key = (string) $key;
        if (!array_key_exists($key, $this->identificationTable)) {
            throw new \InvalidArgumentException(sprintf('There is no identifier with key "%s"', $key));
        }

        $values = $this->identificationTable[$key];

        if (is_array($values) && $oneElementArraysAsSingleValue) {
            if (0 === count($values)) {
                return null;
            }

            if (1 === count($values)) {
                return $values[0];
            }
        }

        return $values;
    }

    /**
     * @param \GraphAware\NeoClient\Formatter\QueryPlan $queryPlan
     */
    public function setQueryPlan(QueryPlan $queryPlan)
    {
        $this->queryPlan = $queryPlan;
    }

    /**
     * @return null|\GraphAware\NeoClient\Formatter\QueryPlan
     */
    public function getQueryPlan()
    {
        return $this->queryPlan;
    }

    /**
     * Returns whether or not this result contains the given identifier
     *
     * @param $identifier
     * @return bool
     */
    public function hasIdentifier($identifier)
    {
        return array_key_exists($identifier, $this->identificationTable);
    }

    /**
     * Returns all the identifiers in the result
     *
     * @return array
     */
    public function getIdentifiers()
    {
        return array_keys($this->identificationTable);
    }
}