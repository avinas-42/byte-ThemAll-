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

/**
 * Adapter class for NeoClient usage < v4
 *
 */
class Adapter
{
    private $service;

    public static function getDefaultResultDataContents()
    {
        return ResultFormatter::getDefaultResultDataContents();
    }

    public function __construct()
    {
        $this->service = new ResponseFormattingService();
    }
}