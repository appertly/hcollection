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

class LazyZipKeyedIterator implements \HH\KeyedIterator
{
    private $it1;
    private $it2;

    public function __construct($it1, $it2)
    {
        $this->it1 = $it1;
        $this->it2 = $it2;
    }
    public function __clone()
    {
        $this->it1 = clone $this->it1;
        $this->it2 = clone $this->it2;
    }
    public function rewind()
    {
        $this->it1->rewind();
        $this->it2->rewind();
    }
    public function valid()
    {
        return ($this->it1->valid() && $this->it2->valid());
    }
    public function next()
    {
        $this->it1->next();
        $this->it2->next();
    }
    public function key()
    {
        return $this->it1->key();
    }
    public function current()
    {
        return \HH\Pair::hacklib_new($this->it1->current(), $this->it2->current());
    }
}
