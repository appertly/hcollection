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

trait StrictIterable
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
        return new LazyIterableView($this);
    }
    public function values()
    {
        return new \HH\Vector($this);
    }
    public function map($callback)
    {
        $res = new \HH\Vector();
        foreach ($this as $v) {
            $res[] = $callback($v);
        }
        return $res;
    }
    public function filter($callback)
    {
        $res = new \HH\Vector();
        foreach ($this as $v) {
            if ($callback($v)) {
                $res[] = $v;
            }
        }
        return $res;
    }
    public function zip($iterable)
    {
        $res = new \HH\Vector();
        $it = $iterable->getIterator();
        foreach ($this as $v) {
            if (!$it->valid()) {
                break;
            }
            $res[] = \HH\Pair::hacklib_new($v, $it->current());
            $it->next();
        }
        return $res;
    }
    public function take($n)
    {
        $res = new \HH\Vector();
        if ($n <= 0) {
            return $res;
        }
        foreach ($this as $v) {
            $res[] = $v;
            if (--$n === 0) {
                break;
            }
        }
        return $res;
    }
    public function takeWhile($fn)
    {
        $res = new \HH\Vector();
        foreach ($this as $v) {
            if (!$fn($v)) {
                break;
            }
            $res[] = $v;
        }
        return $res;
    }
    public function skip($n)
    {
        $res = new \HH\Vector();
        foreach ($this as $v) {
            if ($n <= 0) {
                $res[] = $v;
            } else {
                --$n;
            }
        }
        return $res;
    }
    public function skipWhile($fn)
    {
        $res = new \HH\Vector();
        $skip = true;
        foreach ($this as $v) {
            if ($skip) {
                if ($fn($v)) {
                    continue;
                }
                $skip = false;
            }
            $res[] = $v;
        }
        return $res;
    }
    public function slice($start, $len)
    {
        $res = new \HH\Vector();
        if ($len <= 0) {
            return $res;
        }
        foreach ($this as $v) {
            if ($start !== 0) {
                --$start;
                continue;
            }
            $res[] = $v;
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
    public function lastValue()
    {
        $v = null;
        foreach ($this as $v) {
        }
        return $v;
    }
}
