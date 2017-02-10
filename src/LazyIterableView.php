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

class LazyIterableView implements \HH\HackIterable
{
    public $iterable;

    public function __construct($iterable)
    {
        $this->iterable = $iterable;
    }
    public function getIterator()
    {
        return $this->iterable->getIterator();
    }
    public function toArray()
    {
        $arr = array();
        foreach ($this->iterable as $v) {
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
        return $this->iterable->toVector();
    }
    public function toImmVector()
    {
        return $this->iterable->toImmVector();
    }
    public function toSet()
    {
        return $this->iterable->toSet();
    }
    public function toImmSet()
    {
        return $this->iterable->toImmSet();
    }
    public function lazy()
    {
        return $this;
    }
    public function values()
    {
        return new LazyValuesIterable($this->iterable);
    }
    public function map($callback)
    {
        return new LazyMapIterable($this->iterable, $callback);
    }
    public function filter($callback)
    {
        return new LazyFilterIterable($this->iterable, $callback);
    }
    public function zip($iterable)
    {
        if (is_array($iterable)) {
            $iterable = new \HH\ImmMap($iterable);
        }
        return new LazyZipIterable($this->iterable, $iterable);
    }
    public function take($n)
    {
        return new LazyTakeIterable($this->iterable, $n);
    }
    public function takeWhile($fn)
    {
        return new LazyTakeWhileIterable($this->iterable, $fn);
    }
    public function skip($n)
    {
        return new LazySkipIterable($this->iterable, $n);
    }
    public function skipWhile($fn)
    {
        return new LazySkipWhileIterable($this->iterable, $fn);
    }
    public function slice($start, $len)
    {
        return new LazySliceIterable($this->iterable, $start, $len);
    }
    public function concat($iterable)
    {
        if (is_array($iterable)) {
            $iterable = new \HH\ImmMap($iterable);
        }
        return new LazyConcatIterable($this->iterable, $iterable);
    }
    public function firstValue()
    {
        foreach ($this->iterable as $v) {
            return $v;
        }
        return null;
    }
    public function lastValue()
    {
        $v = null;
        foreach ($this->iterable as $v) {
        }
        return $v;
    }
}
