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

class LazySliceKeyedIterator implements \HH\KeyedIterator
{
    private $it;
    private $start;
    private $len;
    private $currentLen;

    public function __construct($it, $start, $len)
    {
        $this->it = $it;
        $this->start = $start;
        $this->len = $len;
        $this->currentLen = $len;
        while ($start !== 0 && $it->valid()) {
            $it->next();
            --$start;
        }
    }
    public function __clone()
    {
        $this->it = clone $this->it;
    }
    public function rewind()
    {
        $it = $this->it;
        $start = $this->start;
        $len = $this->len;
        $it->rewind();
        $this->currentLen = $len;
        while ($start !== 0 && $it->valid()) {
            $it->next();
            --$start;
        }
    }
    public function valid()
    {
        return $this->it->valid() && $this->currentLen !== 0;
    }
    public function next()
    {
        $this->it->next();
        if ($this->currentLen !== 0) {
            --$this->currentLen;
        }
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
