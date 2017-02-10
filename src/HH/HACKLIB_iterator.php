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
* This serves as a baseclass for iterators for all the containers. It works by
* making use of an integer index which is incremented within the range
* 0 - containersize.
*/
class HACKLIB_iterator implements KeyedIterator
{
    // constructor params
    private $count, $token, $getKeyAndValue;
    // current state
    private $index, $keyAndValue;

    /**
 * @param count : The total size of the container.
 * @param token : This is used to make sure that the iterator stops
 *                   working once the container has been modified.
 * @param getKeyAndValue : This is a function that, given the current index,
 *                            returns the current key and value.
 */
    public function hacklib_init($count, $token, $getKeyAndValue)
    {
        $this->count = $count;
        $this->token = $token;
        $this->getKeyAndValue = $getKeyAndValue;
        $this->rewind();
    }

    public function rewind()
    {
        if ($this->token->isNotExpired()) {
            $this->index = 0;
            $this->keyAndValue = null;
        }
    }

    public function next()
    {
        $this->index++;
        $this->keyAndValue = null;
    }

    private function currentKeyAndValue_UNSAFE()
    {
        if (!$this->keyAndValue) {
            $fn = $this->getKeyAndValue;
            $this->keyAndValue = $fn($this->index);
        }
        return $this->keyAndValue;
    }

    private function validate()
    {
        if ($this->token->isExpired()) {
            throw new \InvalidOperationException(
                'Collection was modified during iteration'
            );
        }
        if (!$this->valid()) {
            throw new \InvalidOperationException('Iterator is not valid');
        }
    }

    public function current()
    {
        $this->validate();
        return $this->currentKeyAndValue_UNSAFE()[1];
    }

    public function key()
    {
        $this->validate();
        return $this->currentKeyAndValue_UNSAFE()[0];
    }

    public function valid()
    {
        return $this->index < $this->count;
    }
}
