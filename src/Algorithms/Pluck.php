<?php

/**
 * Pluck function.
 *
 * pluck :: [a] -> b -> b
 *
 * @author Lochemem Bruno Michael
 * @license Apache 2.0
 */

namespace Chemem\Bingo\Functional\Algorithms;

const pluck = 'Chemem\\Bingo\\Functional\\Algorithms\\pluck';

function pluck($values, $search, $default = null)
{
    $val    = [];
    
    foreach ($values as $idx => $item) {
        if (is_array($values) && $search == $idx) {
            $val[] = $item;
        } elseif (is_object($values) && $search == $idx) {
            $val[] = $item;
        }
    }

    $result = head($val);

    return is_null($result) ? $default : $result;
}
