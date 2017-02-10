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

trait LazyKeyedIterable
{
    public function toArray()
    {
        $arr = array();
        foreach ($this as $k => $v) {
            $arr[$k] = $v;
        }
        return $arr;
    }
    public function toValuesArray()
    {
        $arr = array();
        foreach ($this as $v) {
            $arr[] = $v;
        }
        return $arr;
    }
    public function toKeysArray()
    {
        $arr = array();
        foreach ($this as $k => $_) {
            $arr[] = $k;
        }
        return $arr;
    }
    public function toVector()
    {
        return new \HH\Vector($this);
    }
    public function toImmVector()
    {
        return new \HH\ImmVector($this);
    }
    public function toMap()
    {
        return new \HH\Map($this);
    }
    public function toImmMap()
    {
        return new \HH\ImmMap($this);
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
    public function keys()
    {
        return new LazyKeysIterable($this);
    }
    public function map($callback)
    {
        return new LazyMapKeyedIterable($this, $callback);
    }
    public function mapWithKey($callback)
    {
        return new LazyMapWithKeyIterable($this, $callback);
    }
    public function filter($callback)
    {
        return new LazyFilterKeyedIterable($this, $callback);
    }
    public function filterWithKey($callback)
    {
        return new LazyFilterWithKeyIterable($this, $callback);
    }
    public function zip($iterable)
    {
        if (is_array($iterable)) {
            $iterable = new \HH\ImmMap($iterable);
        }
        return new LazyZipKeyedIterable($this, $iterable);
    }
    public function take($n)
    {
        return new LazyTakeKeyedIterable($this, $n);
    }
    public function takeWhile($fn)
    {
        return new LazyTakeWhileKeyedIterable($this, $fn);
    }
    public function skip($n)
    {
        return new LazySkipKeyedIterable($this, $n);
    }
    public function skipWhile($fn)
    {
        return new LazySkipWhileKeyedIterable($this, $fn);
    }
    public function slice($start, $len)
    {
        return new LazySliceKeyedIterable($this, $start, $len);
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
    public function firstKey()
    {
        foreach ($this as $k => $_) {
            return $k;
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
    public function lastKey()
    {
        $k = null;
        foreach ($this as $k => $_) {
        }
        return $k;
    }
}
