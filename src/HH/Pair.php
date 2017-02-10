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

final class Pair implements \ConstVector, \ArrayAccess, \Stringish, \JsonSerializable
{
    use HACKLIB_ImmVectorLike;

    private static $pCreator;

    public function __construct()
    {
        throw new \InvalidOperationException(
            'Pairs cannot be created using the new operator'
        );
    }

    /**
 * used by HACKLIB_iteratable.
 * returns an iterator of the appropriate type
 */
    protected function hacklib_createNewIterator()
    {
        return new \PairIterator();
    }

    public function __toString()
    {
        return "Pair";
    }

    public function immutable()
    {
        return $this;
    }

    private static function hacklib_new_instance()
    {
        if (!self::$pCreator) {
            self::$pCreator = new \ReflectionClass('\HH\Pair');
        }
        return self::$pCreator->newInstanceWithoutConstructor();
    }

    public static function hacklib_new($p1, $p2)
    {
        $p = static::hacklib_new_instance();
        $p->hacklib_init_t(array($p1, $p2));
        return $p;
    }
    
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
