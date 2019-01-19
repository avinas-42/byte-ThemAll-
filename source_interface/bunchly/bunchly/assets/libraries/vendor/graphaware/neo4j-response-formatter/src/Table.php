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

class Table
{
    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $rows = [];

    /**
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    /**
     * @param array $row
     */
    public function addRow(array $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }
}