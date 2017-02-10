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

trait StrictKeyedIterable
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
        return new LazyKeyedIterableView($this);
    }
    public function values()
    {
        return new \HH\Vector($this);
    }
    public function keys()
    {
        $res = new \HH\Vector();
        foreach ($this as $k => $_) {
            $res[] = $k;
        }
        return $res;
    }
    public function map($callback)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            $res[$k] = $callback($v);
        }
        return $res;
    }
    public function mapWithKey($callback)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            $res[$k] = $callback($k, $v);
        }
        return $res;
    }
    public function filter($callback)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            if ($callback($v)) {
                $res[$k] = $v;
            }
        }
        return $res;
    }
    public function filterWithKey($callback)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            if ($callback($k, $v)) {
                $res[$k] = $v;
            }
        }
        return $res;
    }
    public function zip($iterable)
    {
        $res = new \HH\Map();
        $it = $iterable->getIterator();
        foreach ($this as $k => $v) {
            if (!$it->valid()) {
                break;
            }
            $res[$k] = \HH\Pair::hacklib_new($v, $it->current());
            $it->next();
        }
        return $res;
    }
    public function take($n)
    {
        $res = new \HH\Map();
        if ($n <= 0) {
            return $res;
        }
        foreach ($this as $k => $v) {
            $res[$k] = $v;
            if (--$n === 0) {
                break;
            }
        }
        return $res;
    }
    public function takeWhile($fn)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            if (!$fn($v)) {
                break;
            }
            $res[$k] = $v;
        }
        return $res;
    }
    public function skip($n)
    {
        $res = new \HH\Map();
        foreach ($this as $k => $v) {
            if ($n <= 0) {
                $res[$k] = $v;
            } else {
                --$n;
            }
        }
        return $res;
    }
    public function skipWhile($fn)
    {
        $res = new \HH\Map();
        $skip = true;
        foreach ($this as $k => $v) {
            if ($skip) {
                if ($fn($v)) {
                    continue;
                }
                $skip = false;
            }
            $res[$k] = $v;
        }
        return $res;
    }
    public function slice($start, $len)
    {
        $res = new \HH\Map();
        if ($len <= 0) {
            return $res;
        }
        foreach ($this as $k => $v) {
            if ($start !== 0) {
                --$start;
                continue;
            }
            $res[$k] = $v;
            if (--$len === 0) {
                break;
            }
        }
        return $res;
    }
    public function concat($iterable)
    {
        $res = new \HH\Vector();
        foreach ($this as $v) {
            $res[] = $v;
        }
        foreach ($iterable as $v) {
            $res[] = $v;
        }
        return $res;
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
