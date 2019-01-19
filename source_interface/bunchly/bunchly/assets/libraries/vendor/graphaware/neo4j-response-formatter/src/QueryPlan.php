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

class QueryPlan
{
    /**
     * @var array
     */
    protected $rawPlan;

    /**
     * @param array $queryPlan
     */
    public function __construct(array $queryPlan)
    {
        $this->rawPlan = $queryPlan;
    }

    /**
     * @return array
     */
    public function getRawQueryPan()
    {
        return $this->rawPlan;
    }

    /**
     * @return array
     */
    public function getArrayOutput()
    {
        return $this->rawPlan;
    }
}