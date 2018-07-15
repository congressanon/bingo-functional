<?php

/**
 * Writer monad
 * 
 * @package bingo-functional
 * @author Lochemem Bruno Michael
 * @license Apache 2.0
 */

namespace Chemem\Bingo\Functional\Functors\Monads;

use function \Chemem\Bingo\Functional\Algorithms\concat;

class Writer
{
    /**
     * @access private
     * @var mixed $value
     */
    private $value;

    /**
     * @access private
     * @var string $logMsg
     */
    private $logMsg; 

    /**
     * Writer monad constructor
     * 
     * @param mixed $value
     * @param string $logMsg
     */
    public function __construct($value, $logMsg)
    {
        $this->value = $value;
        $this->logMsg = $logMsg;
    }

    /**
     * of method
     * 
     * @static of
     * @param mixed $value
     * @param string $logMsg
     * @return object Writer
     */

    public static function of($value, string $logMsg) : Writer
    {
        return new static($value, $logMsg);
    }

    /**
     * ap method
     * 
     * @param Writer $app
     * @param string $logMsg
     * @return object Writer
     */
    public function ap(Writer $app, string $logMsg) : Writer
    {
        return $this->map(function ($val) use ($app, $logMsg) { return $app->map($val, $logMsg); }, concat(PHP_EOL, $app->run()[1], $logMsg));
    }

    /**
     * map method
     * 
     * @param callable $function The morphism used to transform the state value
     * @param string $logMsg
     * @return object Writer
     */

    public function map(callable $function, string $logMsg) : Writer
    {
        return self::of(call_user_func($function, $this->value), concat(PHP_EOL, $this->logMsg, $logMsg));
    }
    
    /**
     * bind method
     * 
     * @param callable $function
     * @param string $logMsg
     * @return object Writer
     */

    public function bind(callable $function, string $logMsg) : Writer
    {
        return $this->map($function, $logMsg);
    }

    /**
     * flatMap method
     * 
     * @param callable $function
     * @param string $logMsg
     * @return mixed $result
     */

    public function flatMap(callable $function, string $logMsg) : array
    {
        return [call_user_func($function, $this->value), concat(PHP_EOL, $this->logMsg, $logMsg)];
    }

    /**
     * run method
     * 
     * @return array [$value, $logMsg]
     */

    public function run() : array
    {
        return [$this->value, $this->logMsg];
    }
}