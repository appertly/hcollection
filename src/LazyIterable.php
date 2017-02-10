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

trait LazyIterable
{
    public function toArray()
    {
        $arr = array();
        foreach ($this as $v) {
            $arr[] = $v;
        }
        return $arr;
    }
    public function toValuesArray()
    {
        return $this->toArray();
    }
    public function toVector()
    {
        return new \HH\Vector($this);
    }
    public function toImmVector()
    {
        return new \HH\ImmVector($this);
    }
    public function toSet()
    {
        return new \HH\Set($this);
    }
    public function toImmSet()
    {
        return new \HH\ImmSet($this);
    }
    public function lazy()
    {
        return $this;
    }
    public function values()
    {
        return new LazyValuesIterable($this);
    }
    public function map($callback)
    {
        return new LazyMapIterable($this, $callback);
    }
    public function filter($callback)
    {
        return new LazyFilterIterable($this, $callback);
    }
    public function zip($iterable)
    {
        if (is_array($iterable)) {
            $iterable = new \HH\ImmMap($iterable);
        }
        return new LazyZipIterable($this, $iterable);
    }
    public function take($n)
    {
        return new LazyTakeIterable($this, $n);
    }
    public function takeWhile($fn)
    {
        return new LazyTakeWhileIterable($this, $fn);
    }
    public function skip($n)
    {
        return new LazySkipIterable($this, $n);
    }
    public function skipWhile($fn)
    {
        return new LazySkipWhileIterable($this, $fn);
    }
    public function slice($start, $len)
    {
        return new LazySliceIterable($this, $start, $len);
    }
    public function concat($iterable)
    {
        if (is_array($iterable)) {
            $iterable = new \HH\ImmMap($iterable);
        }
        return new LazyConcatIterable($this, $iterable);
    }
    public function firstValue()
    {
        foreach ($this as $v) {
            return $v;
        }
        return null;
    }
    public function lastValue()
    {
        $v = null;
        foreach ($this as $v) {
        }
        return $v;
    }
}
