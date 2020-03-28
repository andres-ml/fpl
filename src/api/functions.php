<?php

namespace Aml\Fpl\functions;

/**
 * Returns a function that negates the result of calling its argument.
 * 
 * @param callable $function
 * @return callable
 */
function complement($function) : callable
{
    return function(...$args) use($function) {
        return !call_user_func_array($function, $args);
    };
}

/**
 * Function composition
 * 
 * @param callable[] $function
 * @return callable
 */
function compose(...$functions) : callable
{
    return function(...$args) use($functions) {
        $reducer = function($arguments, $function) {
            return [call_user_func_array($function, $arguments)];
        };
        return reduce($reducer, $args, array_reverse($functions))[0];
    };
}

/**
 * Returns the curried version of a function.
 * Once all non-optional, non-variadic parameters have been provided, the function will be called;
 * if you need to curry optional or variadic parameters you must use curryN and specify the number of parameters.
 * 
 * ```
 * $add2AndMore = function($a, $b, ...$rest) {
 *     return $a + $b + array_sum($rest);
 * };
 * 
 * $curried = curry($add2AndMore);
 * $curried()(1)(2);    // 3
 * $curried(1)(2);      // 3
 * $curried(1, 2);      // 3
 * $curried(1, 2, 3);   // 6
 * $curried(1, 2)(3);   // error! calling 3(3)
 * ```
 *
 * @param callable $function
 * @return callable
 */
function curry($function) : callable
{
    $fixedArguments = array_filter((new \ReflectionFunction($function))->getParameters(), function($parameter) {
        return !$parameter->isOptional() && !$parameter->isVariadic();
    });
    return curryN(\count($fixedArguments), $function);
}

/**
 * Curries exactly `$N` parameters of the given function:
 * 
 * ```
 * $add2AndMore = function($a, $b, ...$rest) {
 *     return $a + $b + array_sum($rest);
 * };
 * 
 * $curried = curryN(4, $add2AndMore);
 * $curried(1, 2);          // callable
 * $curried(1, 2, 3);       // callable
 * $curried(1, 2, 3, 4);    // 10
 * ```
 *
 * @param integer $N
 * @param callable $function
 * @return callable
 */
function curryN(int $N, $function) : callable
{
    return function(...$args) use($N, $function) {
        if (\count($args) < $N) {
            return curryN($N - \count($args), partial($function, ...$args));
        }
        return $function(...$args);
    };
}

/**
 * Flips the first two arguments of a function
 *
 * @param callable $function
 * @return callable
 */
function flip($function) : callable
{
    return function($a, $b, ...$args) use($function) {
        return call_user_func($function, $b, $a, ...$args);
    };
}

/**
 * Transforms a function into a fixed arity.
 * 
 * ```
 * map('get_class', $items);            // Error: get_class expected at most 1 parameter but 2 were given
 * map(nAry(1, 'get_class'), $items);   // [...]
 * ```
 *
 * @param integer $arity
 * @param callable $function
 * @return callable
 */
function nAry(int $arity, callable $function) : callable
{
    return function(...$args) use($arity, $function) {
        return call_user_func_array($function, slice(0, $arity, $args));
    };
}

/**
 * Packs the arguments of a function into an tuple/array
 * 
 * ```
 * $sum = pack('array_sum');
 * $sum(1, 2, 3);   // 6
 * ```
 *
 * @param callable $function
 * @return callable
 */
function pack($function) : callable
{
    return function(...$args) use($function) {
        return call_user_func($function, $args);
    };
}

/**
 * Partial application
 *
 * @param callable $function
 * @param mixed ...$partialArgs
 * @return callable
 */
function partial($function, ...$partialArgs) : callable
{
    return function(...$args) use($function, $partialArgs) {
        return call_user_func_array($function, array_merge($partialArgs, $args));
    };
}

/**
 * Function piping. Equivalent to composing with reversed order.
 *
 * @param callable[] ...$functions
 * @return callable
 */
function pipe(...$functions) : callable
{
    return compose(...array_reverse($functions));
}

/**
 * Unpacks/spreads arguments of a function
 * 
 * ```
 * $words = compose(
 *     unpack('array_merge'),
 *     map(nAry(1, partial('explode', ' ')))
 * );
 * $words(['a sentence', 'some other sentence']); // ['a', 'sentence', 'some', 'other', 'sentence']
 * ```
 * 
 * @param callable $function
 * @return callable
 */
function unpack($function) : callable
{
    return partial('call_user_func_array', $function);
}

/**
 * Wraps a function `$function` so that it's called with transformed arguments, as defined
 * by the `$argCallbacks` array.
 * 
 * ```
 * $mergeFirst2 = useWith([slice(0, 2), slice(0, 2)], 'array_merge');
 * $mergeFirst2([1,2,3,4], [5,6,7,8]);  // [1,2,5,6]
 * ```
 * 
 * @param array $argCallbacks
 * @param callable $function
 * @return callable
 */
function useWith(array $argCallbacks, $function) : callable
{
    return function(...$args) use($argCallbacks, $function) {
        $modifyArgument = function($arg, $index) use($argCallbacks) {
            return call_user_func($argCallbacks[$index], $arg);
        };
        return call_user_func_array($function, map($modifyArgument, $args));
    };
}