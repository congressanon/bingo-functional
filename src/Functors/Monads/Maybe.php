<?php

/**
 * Maybe monad
 *
 * @package bingo-functional
 * @author Lochemem Bruno Michael
 * @license Apache-2.0
 */

namespace Chemem\Bingo\Functional\Functors\Monads;

use Chemem\Bingo\Functional\Functors\Functor;
use Chemem\Bingo\Functional\Functors\ApplicativeFunctor;

abstract class Maybe implements Monad, Functor, ApplicativeFunctor
{
  public const just      = __CLASS__ . '::just';

  public const nothing   = __CLASS__ . '::nothing';

  public const fromValue = __CLASS__ . '::fromValue';

  public const lift      = __CLASS__ . '::lift';

  /**
   * just
   * puts value in Just context
   *
   * just :: a -> m a
   *
   * @param mixed $value
   * @return Just
   */
  public static function just($value): Monad
  {
    return new Just($value);
  }

  /**
   * nothing
   * creates a Nothing object
   *
   * nothing :: m a
   *
   * @return Nothing
   */
  public static function nothing(): Monad
  {
    return new Nothing();
  }

  /**
   * fromValue
   * creates Just or Nothing from value pair
   *
   * fromValue :: a -> b -> m a
   *
   * @param mixed $just
   * @param mixed $nothing
   * @return Maybe
   */
  public static function fromValue($just, $nothing = null): Monad
  {
    return $just !== $nothing ? self::just($just) : self::nothing();
  }

  /**
   * of
   * puts value in Maybe monad
   *
   * of :: a -> m a
   *
   * @abstract
   * @param mixed $value
   * @return Maybe
   */
  abstract public static function of($value): Monad;

  /**
   * getJust
   * unwraps Just value
   *
   * getJust :: Maybe => m a -> a
   *
   * @abstract
   * @return mixed
   */
  abstract public function getJust();

  /**
   * getNothing()
   * unwraps Nothing value - a unit type
   *
   * getNothing :: Maybe => m a -> Null
   *
   * @abstract
   * @return null
   */
  abstract public function getNothing();

  /**
   * isJust
   * checks if Maybe value is of type Just
   *
   * isJust :: Maybe => m a -> Bool
   *
   * @abstract
   * @return boolean
   */
  abstract public function isJust(): bool;

  /**
   * isNothing
   * checks if Maybe value is of type Nothing
   *
   * isNothing :: Maybe => m a -> Bool
   *
   * @abstract
   * @return boolean
   */
  abstract public function isNothing(): bool;

  /**
   * flatMap
   * behaves like map but returns an unwrapped value
   *
   * flatMap :: Maybe => m a -> (a -> b) -> b
   *
   * @abstract
   * @param callable $function
   * @return mixed
   */
  abstract public function flatMap(callable $fn);

  /**
   * {@inheritDoc}
   */
  abstract public function ap(ApplicativeFunctor $app): ApplicativeFunctor;

  /**
   * getOrElse
   * extract final Just value if present and supplied argument otherwise
   *
   * getOrElse :: Maybe => m a -> b -> a
   *
   * @abstract
   * @param mixed $default
   * @return mixed
   */
  abstract public function getOrElse($default);

  /**
   * {@inheritDoc}
   */
  abstract public function map(callable $function): Functor;

  /**
   * {@inheritDoc}
   */
  abstract public function bind(callable $function): Monad;

  /**
   * filter
   * retains value that satisfies boolean predicate; Nothing otherwise
   *
   * filter :: Maybe => m a -> (a -> Bool) -> m a
   *
   * @abstract
   * @param callable $filter
   * @return Maybe
   */
  abstract public function filter(callable $filter): Monad;

  /**
   * orElse
   * chainable version of fromMaybe
   *
   * orElse :: Maybe => m a -> m a
   *
   * @abstract
   * @param Maybe $value
   * @return Maybe
   */
  abstract public function orElse(Maybe $value): Maybe;
}
