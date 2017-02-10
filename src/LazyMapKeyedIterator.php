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

class LazyMapKeyedIterator implements \HH\KeyedIterator
{
    private $it;
    private $fn;

    public function __construct($it, $fn)
    {
        $this->it = $it;
        $this->fn = $fn;
    }
    public function __clone()
    {
        $this->it = clone $this->it;
    }
    public function rewind()
    {
        $this->it->rewind();
    }
    public function valid()
    {
        return $this->it->valid();
    }
    public function next()
    {
        $this->it->next();
    }
    public function key()
    {
        return $this->it->key();
    }
    public function current()
    {
        $fn = $this->fn;
        return $fn($this->it->current());
    }
}
