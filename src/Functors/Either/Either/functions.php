<?php

/**
 * 
 * Either type helper functions
 * 
 * @see http://hackage.haskell.org/package/base-4.11.1.0/docs/Data-Either.html
 * @package bingo-functional
 * @author Lochemem Bruno Michael
 * @license Apache-2.0
 */

namespace Chemem\Bingo\Functional\Functors\Either;

use Chemem\Bingo\Functional\Functors\Either as Etype;

/**
 * 
 * either function
 * Case analysis for the either type
 * 
 * either :: (a -> c) -> (b -> c) -> Either a b -> c
 * 
 * @param callable $left
 * @param callable $right
 * @param object Either
 * @return mixed
 */

const either = 'Chemem\\Bingo\\Functional\\Functors\\Either\\either';

function either(callable $right, callable $left, Etype $either)
{
    return $either instanceof Either\Left ? 
        $left($either->getLeft()) : 
        $right($either->getRight()); 
}

function _extract(array $eithers, string $instance)
{
    return array_filter(
        $eithers,
        function (Etype $either) use ($instance) {
            return $either instanceof $instance;
        }
    );
}

/**
 * 
 * lefts function
 * Extracts from a list of Either all the Left elements
 * 
 * lefts :: [Either a b] -> [a]
 * 
 * @param array $eithers
 * @return array 
 */

const lefts = 'Chemem\\Bingo\\Functional\\Functors\\Either\\lefts';

function lefts(array $eithers) : array
{
    return _extract($eithers, Either\Left::class);
}

/**
 * 
 * rights function
 * Extracts from a list of Either all the Right elements
 * 
 * rights :: [Either a b] -> [b]
 * 
 * @param array $eithers
 * @return array 
 */

const rights = 'Chemem\\Bingo\\Functional\\Functors\\Either\\rights';

function rights(array $eithers) : array
{
    return _extract($eithers, Either\Right::class);
}

/**
 * 
 * fromRight function
 * Return the contents of a Right-value or a default value otherwise
 * 
 * fromRight :: b -> Either a b -> b
 * 
 * @param mixed $default
 * @param object Either $either
 * @return mixed
 */

const fromRight = 'Chemem\\Bingo\\Functional\\Functors\\Either\\fromRight';

function fromRight($default, Etype $either)
{
    return $either->isRight() ? $either->getRight() : $default;
}

/**
 * 
 * fromLeft function
 * Return the contents of a Left-value or a default value otherwise
 * 
 * fromLeft :: a -> Either a b -> a
 * 
 * @param mixed $default
 * @param object Either $either
 * @return mixed
 */

const fromLeft = 'Chemem\\Bingo\\Functional\\Functors\\Either\\fromLeft';

function fromLeft($default, Etype $either)
{
    return $either->isLeft() ? $either->getLeft() : $default;
}
