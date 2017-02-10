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
* adds a few simple methods to all containers that implement
* iterators, mainly implemented so we can consolidate all
* the logic dealing with iterators in one place.
*/
trait HACKLIB_iteratable
{
//this is a token passed to all iterators so it can be invalidated.
    private $iteratorToken;

/**
* All iterators share a token that becomes invalidated the minute the
* container is mutated. This creates a new token incase the current
* one does not exist.
*/
    private function getCurrentToken()
    {
        if (!$this->iteratorToken) {
            $this->iteratorToken = new HACKLIB_IteratorToken();
        }
        return $this->iteratorToken;
    }

    protected function hacklib_expireAllIterators()
    {
        if ($this->iteratorToken) {
            $this->iteratorToken->expire();
            $this->iteratorToken = null;
        }
    }

/**
*  return the key and value at index i for this container
*/
    protected abstract function hacklib_getKeyAndValue($i);

/**
*  return the size of the given container
*/
    public abstract function count();

/**
*  create a new iterator of the required type.
*/
    protected abstract function hacklib_createNewIterator();

/**
* Returns an iterator that points to the beginning of this Container.
*/
    public function getIterator()
    {
        $iterator = $this->hacklib_createNewIterator();
        $iterator->hacklib_init(
            $this->count(),
            $this->getCurrentToken(),
            function ($i) {
                return $this->hacklib_getKeyAndValue($i);
            }
        );
        return $iterator;
    }
}
