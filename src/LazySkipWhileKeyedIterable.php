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

class LazySkipWhileKeyedIterable implements \HH\HackIterable
{
    use LazyIterable;

    private $iterable;
    private $fn;

    public function __construct($iterable, $fn)
    {
        $this->iterable = $iterable;
        $this->fn = $fn;
    }
    public function getIterator()
    {
        return new LazySkipWhileKeyedIterator(
            $this->iterable->getIterator(),
            $this->fn
        );
    }
}
