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

interface ResultInterface
{
    /**
     * @return mixed
     */
    public function getNodes();

    /**
     * @return mixed
     */
    public function getRelationships();

    /**
     * @param $identifier
     * @return mixed
     */
    public function get($identifier);
}