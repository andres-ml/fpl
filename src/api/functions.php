<?php

namespace Aml\Fpl\functions;

use Aml\Fpl;

/**
 * Returns a function that negates the result of calling its argument.
 * 
 * ```
 * $isEven = function($x) { return $x % 2 === 0; };
 * $isOdd = complement($isEven);
 * ```
 * @param callable $function
 * @return callable
 */
function complement(callable $function) : callable
{
    return function(...$args) use($function) {
        return !call_user_func_array($function, $args);
    };
}

/**
 * Function composition
 * 
 * ```
 * compose(last, slice(1, 3), counter)(10); // 13
 * ```
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
function curry(callable $function) : callable
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
function curryN(int $N, callable $function) : callable
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
 * ```
 * $prepend = flip('array_merge');
 * $prepend([1], [2], [3]]); // [2, 1, 3]
 * ```
 *
 * @param callable $function
 * @return callable
 */
function flip(callable $function) : callable
{
    return function($a, $b, ...$args) use($function) {
        return call_user_func($function, $b, $a, ...$args);
    };
}

/**
 * Returns a callable that will invoke `$method` on its sole argument, with the specified `$args`
 * 
 * ```
 * // assuming that Pete and Carl are aged 30 and 25 respectively, and
 * // that $Pete and $Carl are instances of Person, which defines a method getAge():
 * map(invoker('getAge'), [$Pete, $Carl]);  // [30, 25]
 * ```
 *
 * @param string $method
 * @param mixed[] ...$args
 * @return callable
 */
function invoker(string $method, ...$args) : callable
{
    return function($object) use($method, $args) {
        return call_user_func_array([$object, $method], $args);
    };
}

/**
 * Transforms a function into a fixed arity.
 * 
 * ```
 * map('get_class', $items); // Error: get_class expected at most 1 parameter but 2 were given
 * map(nAry(1, 'get_class'), $items); // [...]
 * ```
 *
 * @param integer $arity
 * @param callable $function
 * @return callable
 */
function nAry(int $arity, callable $function) : callable
{
    return function(...$args) use($arity, $function) {
        return call_user_func_array($function, Fpl\slice(0, $arity, $args));
    };
}

/**
 * Packs the arguments of a function into an tuple/array
 * 
 * ```
 * $sum = pack('array_sum');
 * $sum(1, 2, 3); // 6
 * ```
 *
 * @param callable $function
 * @return callable
 */
function pack(callable $function) : callable
{
    return function(...$args) use($function) {
        return call_user_func($function, $args);
    };
}

/**
 * Partial application
 * 
 * ```
 * $prepend1 = partial('array_merge', [1]);
 * $prepend1([2, 3]); // [1, 2, 3]
 * ```
 *
 * @param callable $function
 * @param mixed ...$partialArgs
 * @return callable
 */
function partial(callable $function, ...$partialArgs) : callable
{
    return function(...$args) use($function, $partialArgs) {
        return call_user_func_array($function, array_merge($partialArgs, $args));
    };
}

/**
 * Function piping. Equivalent to composing with reversed order.
 * 
 * ```
 * pipe(counter, head)(3); // 3
 * ```
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
function unpack(callable $function) : callable
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
function useWith(array $argCallbacks, callable $function) : callable
{
    return function(...$args) use($argCallbacks, $function) {
        $modifyArgument = function($arg, $index) use($argCallbacks) {
            return call_user_func($argCallbacks[$index], $arg);
        };
        return call_user_func_array($function, Fpl\map($modifyArgument, $args));
    };
}