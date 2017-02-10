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
* Trait that ensures that all mutableish methods that are implemented by
* immutable vectors throws errors.
*/
trait HACKLIB_ImmVectorLike
{
    use HACKLIB_ConstVectorLike;
    use HACKLIB_CommonImmMutableContainerMethods;

    /**
 * identical to at, implemented for ArrayAccess
 */
    public function offsetGet($offset)
    {
        $this->hacklib_validateKeyType($offset);
        $this->hacklib_validateKeyBounds($offset);
        return $this->container[$offset];
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

    protected function hacklib_isImmutable()
    {
        return true;
    }
}
