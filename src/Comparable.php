<?php

namespace Sorting;

use Sorting\Exception\InvalidComparisonException;

/**
 * Interface for the natural ordering of objects.
 *
 * @package Sorting
 */
interface Comparable {

    /**
     * Compares the current object to the passed $other.
     *
     * Returns 0 if they are semantically equal, 1 if the other object
     * is less than the current one, or -1 if its more than the current one.
     *
     * @param mixed $other
     *
     * @return int
     * @throws InvalidComparisonException
     */
    public function compareTo($other);
}