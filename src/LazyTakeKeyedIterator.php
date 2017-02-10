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

class LazyTakeKeyedIterator implements \HH\KeyedIterator
{
    private $it;
    private $n;
    private $numLeft;

    public function __construct($it, $n)
    {
        $this->it = $it;
        $this->n = $n;
        $this->numLeft = $n;
    }
    public function __clone()
    {
        $this->it = clone $this->it;
    }
    public function rewind()
    {
        $this->it->rewind();
        $this->numLeft = $this->n;
    }
    public function valid()
    {
        return ($this->numLeft > 0 && $this->it->valid());
    }
    public function next()
    {
        $this->it->next();
        --$this->numLeft;
    }
    public function key()
    {
        return $this->it->key();
    }
    public function current()
    {
        return $this->it->current();
    }
}
