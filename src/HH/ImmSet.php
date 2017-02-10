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
* ImmSet is an immutable Set.
*/
final class ImmSet implements \ConstSet, \ArrayAccess, \Stringish, \JsonSerializable
{
    use HACKLIB_ImmSetLike;
    /**
 * Create an ImmSet (if no parameters are passed) or create
 * an ImmSet from an Traversable (if one parameter is passed).
 */
    public function __construct($it = null)
    {
        $this->hacklib_init_t($it);
    }

    public function __toString()
    {
        return "ImmSet";
    }

    public function jsonSerialize()
    {
        return $this->toValuesArray();
    }

    public static function of(...$values): ImmSet
    {
        return new ImmSet($values);
    }
}
