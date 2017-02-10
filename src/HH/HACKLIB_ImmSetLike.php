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

trait HACKLIB_ImmSetLike
{
    use HACKLIB_ConstSetLike;
    use HACKLIB_CommonImmMutableContainerMethods;

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            throw new \InvalidOperationException(
                'Cannot modify immutable object of type '.get_class($this)
            );
        } else {
            throw new \InvalidOperationException(
                '[] operator cannot be used to modify elements of a Set'
            );
        }
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
