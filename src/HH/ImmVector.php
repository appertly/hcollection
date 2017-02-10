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
* ImmVector is an immutable Vector.
*
* A ImmVector cannot be mutated. No elements can be added or removed from it,
* nor can elements be overwritten using assignment (i.e. "$c[$k] = $v" is not
* allowed).
*
*   $v = new Vector(array(1, 2, 3));
*   $fv = $v->toImmVector();
*
* construct it with a Traversable
*
*   $a = array(1, 2, 3);
*   $fv = new ImmVector($a);
*
*/
final class ImmVector implements \ConstVector, \ArrayAccess, \Stringish, \JsonSerializable
{
    use HACKLIB_ImmVectorLike;
    /**
 * Create an empty ImmVector (if no parameters are passed) or create
 * an ImmVector from an Traversable (if one parameter is passed).
 */
    public function __construct($it = null)
    {
        $this->hacklib_init_t($it);
    }

    public function __toString()
    {
        return "ImmVector";
    }

    public function immutable()
    {
        return $this;
    }
    /**
 * Returns an ImmVector built from the keys of the specified container.
 */
    public static function fromKeysOf($it)
    {
        if (is_array($it)) {
            return new self(array_keys($it));
        }
        if ($it instanceof \HH\KeyedIterable) {
            return new self($it->keys());
        }
        if (is_null($it)) {
            return new self();
        }
        throw new \InvalidArgumentException(\sprintf(
            'Parameter must be a container (array or collection), got %s',
            is_object($it) ? get_class($it) : gettype($it)
        ));
    }

    /**
 * used by HACKLIB_iteratable.
 * returns an iterator of the appropriate type
 */
    protected function hacklib_createNewIterator()
    {
        return new \VectorIterator();
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public static function of(...$values): ImmVector
    {
        return new ImmVector($values);
    }
}
