<?php
/**
 * hcollection. Forked from hack.
 *
 * @copyright 2017 Appertly
 * @copyright 2014 Facebook, Inc. All rights reserved.
 * @license BSD-3-Clause
 *
 * Original license can be found in the THIRD-PARTY file at the root of this
 * source tree. An additional grant of patent rights can be found in the
 * PATENTS file in the "hphp/hack" directory of the HHVM Git repository.
 */

class LazyConcatIterator implements \HH\Iterator
{
    private $it1;
    private $it2;
    private $currentIt;
    private $state;

    public function __construct($it1, $it2)
    {
        $this->it1 = $it1;
        $this->it2 = $it2;
        $this->currentIt = $it1;
        $this->state = 1;
        if (!$this->currentIt->valid()) {
            $this->currentIt = $this->it2;
            $this->state = 2;
        }
    }
    public function __clone()
    {
        $this->it1 = clone $this->it1;
        $this->it2 = clone $this->it2;
        $this->currentIt = ($this->state === 1) ? $this->it1 : $this->it2;
    }
    public function rewind()
    {
        $this->it1->rewind();
        $this->it2->rewind();
        $this->currentIt = $this->it1;
        $this->state = 1;
        if (!$this->currentIt->valid()) {
            $this->currentIt = $this->it2;
            $this->state = 2;
        }
    }
    public function valid()
    {
        return $this->currentIt->valid();
    }
    public function next()
    {
        $this->currentIt->next();
        if ($this->state === 1 && !$this->currentIt->valid()) {
            $this->currentIt = $this->it2;
            $this->state = 2;
        }
    }
    public function key()
    {
        return $this->currentIt->key();
    }
    public function current()
    {
        return $this->currentIt->current();
    }
}
