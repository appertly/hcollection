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

trait HACKLIB_ImmMapLike
{
    use HACKLIB_ConstMapLike;
    use HACKLIB_CommonImmMutableContainerMethods;

    /**
 * identical to at, implemented for ArrayAccess
 */
    public function offsetGet($offset)
    {
        list($contained, $k_actual) = $this->hacklib_containsKey($offset);
        if ($contained) {
            return $this->container[$k_actual];
        }
        if (is_int($offset)) {
            throw new \OutOfBoundsException("Integer key $offset is not defined");
        } else {
            if (strlen($offset) > 100) {
                $offset = "\"".substr($offset, 0, 100)."\""." (truncated)";
            } else {
                $offset = "\"$offset\"";
            }
            throw new \OutOfBoundsException("String key $offset is not defined");
        }
    }

    public function offsetSet($offset, $value)
    {
        throw new \InvalidOperationException(
            'Cannot modify immutable object of type '.get_class($this)
        );
    }

    public function offsetUnset($offset)
    {
        throw new \InvalidOperationException(
            'Cannot modify immutable object of type '.get_class($this)
        );
    }

    public function immutable()
    {
        return $this;
    }

    protected function hacklib_isImmutable()
    {
        return true;
    }
}
