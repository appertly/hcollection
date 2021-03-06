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
namespace HH;

/**
* Set is an ordered set-style collection.
*
* Like all objects in PHP, Sets have reference-like semantics. When a caller
* passes a Set to a callee, the callee can modify the Set and the caller will
* see the changes. Sets do not have "copy-on-write" semantics.
*
* Sets preserve insertion order of the elements. When iterating over a Set,
* the elements appear in the order they were inserted. Also, Sets do not
* automagically convert integer-like strings (ex. "123") into integers.
*
* Sets only support integer values and string values. If a value of a
* different type is used, an exception will be thrown.
*
* In general, Sets do not support "$c[$k]" style syntax. Adding an element
* using "$c[] = .." syntax is supported.
*
* Set do not support iteration while elements are being added or removed.
* When an element is added or removed, all iterators that point to the Set
* shall be considered invalid.
*
* Sets do not support taking elements by reference. If binding assignment (=&)
* is used when adding a new element to a Set (ex. "$c[] =& ..."), or if a Set
* is used with foreach by reference, an exception will be thrown.
*/

final class Set implements \MutableSet, \ArrayAccess, \Stringish, \JsonSerializable
{
    use HACKLIB_SetLike;
    const MAX_SIZE = 1610612736;

    public function __construct($it = null)
    {
        $this->hacklib_init_t($it);
    }

    public function __toString()
    {
        return "Set";
    }

    public function jsonSerialize()
    {
        return $this->toValuesArray();
    }

    public static function of(...$values): Set
    {
        return new Set($values);
    }
}
