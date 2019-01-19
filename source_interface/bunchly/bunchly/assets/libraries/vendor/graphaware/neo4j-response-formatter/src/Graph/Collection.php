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

class Collection
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @param $element
     * @param null $key
     */
    protected function addElement($element, $key = null)
    {
        if (!in_array($element, $this->elements)) {
            $k = null !== $key ? $key : count($this->elements)-1;
            $this->elements[$k] = $element;
        }
    }

    /**
     * @return array
     */
    protected function getElements()
    {
        return $this->elements;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getElement($key)
    {
        if (!array_key_exists($key, $this->elements)) {
            throw new \InvalidArgumentException(sprintf('The element with key %s is not in the Collection', $key));
        }

        return $this->elements[$key];
    }

    /**
     * @param $element
     * @return bool
     */
    protected function hasElement($element)
    {
        return in_array($element, $this->elements);
    }
}