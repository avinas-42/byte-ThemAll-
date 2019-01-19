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

use GraphAware\NeoClient\Formatter\Graph\Collection;

class StatementsCollection extends Collection
{
    /**
     * @param \GraphAware\NeoClient\Formatter\Query\Statement $statement
     */
    public function addStatement(Statement $statement)
    {
        $this->addElement($statement, $statement->getTag());
    }

    /**
     * @return \GraphAware\NeoClient\Formatter\Query\Statement[]
     */
    public function getStatements()
    {
        return $this->getElements();
    }

    /**
     * @param $key
     * @return \GraphAware\NeoClient\Formatter\Query\Statement
     */
    public function getStatement($key)
    {
        return $this->getElement($key);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $statements = ['statements' => []];
        foreach ($this->getStatements() as $statement) {
            $statements['statements'][] = $statement->toArray();
        }

        return $statements;
    }

    /**
     * @param bool $pretty
     * @return string
     */
    public function toJson($pretty = false)
    {
        $prettyFormat = true === $pretty ? JSON_PRETTY_PRINT : null;

        return json_encode($this->toArray(), $prettyFormat);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return 0 < count($this->elements);
    }
}