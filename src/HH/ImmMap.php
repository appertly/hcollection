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
* ImmMap is an immutable Map.
*
* A ImmMap cannot be mutated. No elements can be added or removed from it,
* nor can elements be overwritten using assignment (i.e. "$c[$k] = $v" is
* not allowed).
*
* Construct it with a Traversable
*
*   $a = array('a' => 1, 'b' => 2);
*   $fm = new ImmMap($a);
*
*   $fm = ImmMap::hacklib_new(array('a', 'b'),array(1, 2));
*
* Maps in Hack do not mix integer and string keys like regular php arrays.
* To accommodate this, we prepend any key with a special string prefix,
* "INT" when it's an int, and "STRING" when its a string.
*/

final class ImmMap implements \ConstMap, \ArrayAccess, \Stringish, \JsonSerializable
{
    use HACKLIB_ImmMapLike;
    /**
 * Create an empty ImmMap (if no parameters are passed) or create
 * an ImmMap from an KeyedTraversable (if one parameter is passed).
 */
    public function __construct($it = null)
    {
        $this->hacklib_init_t($it);
    }

    public function map($callback)
    {
        return $this->hacklib_map($callback);
    }

    public function __toString()
    {
        return "ImmMap";
    }

    public static function hacklib_new($keys, $values)
    {
        $m = new ImmMap();
        $m->hacklib_init_kv($keys, $values);
        return $m;
    }

    public function jsonSerialize()
    {
        return (object) $this->toArray();
    }

    public static function of(...$keysAndValues): ImmMap
    {
        $values = [];
        foreach (array_chunk($keysAndValues, 2) as $pair) {
            $values[$pair[0]] = $pair[1] ?? null;
        }
        return new ImmMap($values);
    }
}
