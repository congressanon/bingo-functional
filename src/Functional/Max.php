<?php

/**
 * max function.
 *
 * @package bingo-functional
 * @author Lochemem Bruno Michael
 * @license Apache-2.0
 */

namespace Chemem\Bingo\Functional;

const max = __NAMESPACE__ . '\\max';

/**
 * max
 * computes the largest number in a collection
 *
 * max :: [a] -> Int
 *
 * @param array|object $list
 * @return int|float
 * @example
 *
 * max((object) [12, 4, 6, 99, 3])
 * => 99
 */
function max($list)
{
  return fold(function ($acc, $val) {
    // check if list value is one of either integer or float
    $comp = \filter_var($val, FILTER_VALIDATE_FLOAT | FILTER_VALIDATE_INT);

    return $comp ? ($val > $acc ? $val : $acc) : $acc;
  }, $list, 0);
}
