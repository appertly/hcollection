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

class LazyKVZipIterator implements \HH\Iterator
{
    private $it;

    public function __construct($it)
    {
        $this->it = $it;
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
        return null;
    }
    public function current()
    {
        return \HH\Pair::hacklib_new($this->it->key(), $this->it->current());
    }
}
