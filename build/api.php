<?php

/* This file was automatically generated */
namespace Aml\Fpl;

/**
 * Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
const all = 'Aml\\Fpl\\all';
/**
 * Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
const any = 'Aml\\Fpl\\any';
/**
 * Groups items in chunks of size `$size`. Note that keys are lost in the process.
 *
 * @param integer $size
 * @param iterable $items
 * @return iterable
 */
const chunk = 'Aml\\Fpl\\chunk';
/**
 * Returns a function that negates the result of calling its argument.
 * 
 * @param callable $function
 * @return callable
 */
const complement = 'Aml\\Fpl\\complement';
/**
 * Function composition
 * 
 * @param callable[] $function
 * @return callable
 */
const compose = 'Aml\\Fpl\\compose';
/**
 * Instantiates/constructs an instance of `$class` with the specified arguments.
 *
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
const construct = 'Aml\\Fpl\\construct';
/**
 * Generates integers from `$from` to `$to` with a step of `$step`.
 * Similar to range() but as a generator.
 *
 * @param integer $from
 * @param integer $to
 * @param integer $step
 * @return iterable
 */
const counter = 'Aml\\Fpl\\counter';
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
const curry = 'Aml\\Fpl\\curry';
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
const curryN = 'Aml\\Fpl\\curryN';
/**
 * Drops items from `$items` until `$function($item)` is false.
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const dropWhile = 'Aml\\Fpl\\dropWhile';
/**
 * Runs a callback over each item in `$items`.
 * Returns the same `$items` iterable, which might be useful for chaining.
 * 
 * @param callable $callback
 * @param iterable $items
 * @return iterable
 */
const each = 'Aml\\Fpl\\each';
/**
 * Filters items that do not return a truthy value for `$function`
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const filter = 'Aml\\Fpl\\filter';
/**
 * Flattens an iterable up to depth `$depth`. Keys are not preserved.
 * You can perform a full flatten by using flatten(INF).
 *
 * @param number $depth
 * @param iterable $items
 * @return iterable
 */
const flatten = 'Aml\\Fpl\\flatten';
/**
 * Flips the first two arguments of a function
 *
 * @param callable $function
 * @return callable
 */
const flip = 'Aml\\Fpl\\flip';
/**
 * Builds an associative iterable based on an iterable of pairs.
 * 
 * ```
 * fromPairs([['a', 1], ['b', 2]]); // ['a' => 1, 'b' => 2]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return iterable
 */
const fromPairs = 'Aml\\Fpl\\fromPairs';
/**
 * Groups each item `$item` in `$items` by the value provided by `$grouper($item)`.
 * 
 * ```
 * $grouped = groupBy(index('age'), [
 *      ['name' => 'Pete', 'age' => 30],
 *      ['name' => 'Carl', 'age' => 25],
 *      ['name' => 'Martha', 'age' => 30],
 * ]);
 * ```
 * 
 * Results in the following array:
 * ```
 * [
 *  30 => [
 *      ['name' => 'Pete', 'age' => 30],
 *      ['name' => 'Martha', 'age' => 30],
 *  ],
 *  25 => [
 *      ['name' => 'Carl', 'age' => 25],
 *  ],
 * ]
 * ```
 * 
 * @param callable $grouper
 * @param iterable $items
 * @return iterable
 */
const groupBy = 'Aml\\Fpl\\groupBy';
/**
 * Returns the first element in `$items`, if any
 *
 * @param iterable $items
 * @return mixed
 */
const head = 'Aml\\Fpl\\head';
/**
 * Returns its sole argument as is.
 * 
 * Useful as a placeholder filter; e.g.:
 * ```
 * any(identity, [0, 1, 2]);    // [1, 2]
 * ```
 *
 * @param mixed $item
 * @return mixed
 */
const identity = 'Aml\\Fpl\\identity';
/**
 * Accesses `$array` at its position `$index`.
 *
 * @param mixed $index
 * @param array|\ArrayAccess $array
 * @return mixed
 */
const index = 'Aml\\Fpl\\index';
/**
 * Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
 *
 * @param mixed $index
 * @param mixed $else
 * @param array|\ArrayAccess $array
 * @return void
 */
const indexOr = 'Aml\\Fpl\\indexOr';
/**
 * Returns a callable that will invoke $method on its sole argument, with the specified `$args`
 * 
 * Assuming `$Pete`, `$Carl` are instances of `Person`, which defines a method `getAge()`:
 * map(invoker('getAge'), [$Pete, $Carl]);  // [30, 25]
 *
 * @param string $method
 * @param mixed[] ...$args
 * @return callable
 */
const invoker = 'Aml\\Fpl\\invoker';
/**
 * Returns the keys of `$items`
 *
 * @param iterable $items
 * @return iterable
 */
const keys = 'Aml\\Fpl\\keys';
/**
 * Returns the last item in `$items`, if any
 *
 * @param iterable $items
 * @return mixed
 */
const last = 'Aml\\Fpl\\last';
/**
 * Maps `$items` with `$function`
 * 
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const map = 'Aml\\Fpl\\map';
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
const nAry = 'Aml\\Fpl\\nAry';
/**
 * Filters `$items` by keys that do NOT belong in `$keys`.
 * 
 * ```
 * omit(['password'], ['name' => 'Pete', 'password' => 'secret']); // ['name' => 'Pete]
 * ```
 *
 * @param array $indices
 * @param iterable $items
 * @return iterable
 */
const omit = 'Aml\\Fpl\\omit';
/**
 * Filters `$items` by those who do not pass `$function`.
 * 
 * ```
 * omitBy(index('admin'), [
 *     ['name' => 'Pete', 'admin' => true],
 *     ['name' => 'Carl', 'admin' => false],
 * ]);
 * ```
 * 
 * Would result in:
 * ```
 * [
 *     ['name' => 'Carl', 'admin' => false],
 * ]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const omitBy = 'Aml\\Fpl\\omitBy';
/**
 * Partial application
 *
 * @param callable $function
 * @param mixed ...$partialArgs
 * @return callable
 */
const partial = 'Aml\\Fpl\\partial';
/**
 * Filters `$items` by keys that belong in `$keys`.
 * 
 * ```
 * pick(['age'], ['age' => 30, 'name' => 'Pete']); // ['age' => 30]
 * ```
 *
 * @param array $indices
 * @param iterable $items
 * @return iterable
 */
const pick = 'Aml\\Fpl\\pick';
/**
 * Filters `$items` that pass the specified `$function`.
 * This function is equivalent to `filter`
 * 
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const pickBy = 'Aml\\Fpl\\pickBy';
/**
 * Function piping. Equivalent to composing with reversed order.
 *
 * @param callable[] ...$functions
 * @return callable
 */
const pipe = 'Aml\\Fpl\\pipe';
/**
 * Attempts to get property `$property` from object `$object`.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
const prop = 'Aml\\Fpl\\prop';
/**
 * Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
const propOr = 'Aml\\Fpl\\propOr';
/**
 * Array reducing, a.k.a. foldl.
 *
 * @param callable $function reducer function
 * @param mixed $initial initial value
 * @param iterable $items
 * @return iterable
 */
const reduce = 'Aml\\Fpl\\reduce';
/**
 * Returns the first item in `$items` for which `$callback($item)` is truthy
 *
 * @param callable $callback
 * @param iterable $items
 * @return mixed
 */
const search = 'Aml\\Fpl\\search';
/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
 *
 * @param integer $start
 * @param number $length
 * @param iterable $items
 * @return iterable
 */
const slice = 'Aml\\Fpl\\slice';
/**
 * Sorts `$items`. Note that return type will be array regardless of `$items`,
 * and the array will be sorted in place, since we use php's `usort`
 *
 * @param callable $comparator function that takes 2 values and returns an integer -1, 0, 1
 * @param iterable $items
 * @return array
 */
const sort = 'Aml\\Fpl\\sort';
/**
 * Similar to sort, but using a function that returns a value to use as comparison for each item.
 * 
 * sortBy(index('age'), [
 *     ['name' => 'Pete', 'age' => 30],
 *     ['name' => 'Carl', 'age' => 25],
 * ]);
 * 
 * Would result in:
 * [
 *     ['name' => 'Carl', 'age' => 25],
 *     ['name' => 'Pete', 'age' => 30],
 * ]
 *
 * @param callable $function function that takes an item and returns a value that can be compared with php's spaceship operator <=>
 * @param iterable $items
 * @return array
 */
const sortBy = 'Aml\\Fpl\\sortBy';
/**
 * Applies the spaceship operator on its two arguments
 *
 * @param mixed $a
 * @param mixed $b
 * @return integer
 */
const spaceship = 'Aml\\Fpl\\spaceship';
/**
 * Takes items from `$items` until `$function($item)` yields false
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
const takeWhile = 'Aml\\Fpl\\takeWhile';
/**
 * Iterable to array
 *
 * @param iterable $items
 * @return iterable
 */
const toArray = 'Aml\\Fpl\\toArray';
/**
 * Iterable to iterator
 *
 * @param iterable $items
 * @return iterable
 */
const toIterator = 'Aml\\Fpl\\toIterator';
/**
 * From associative iterable to a list of pairs.
 * 
 * ```
 * fromPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return iterable
 */
const toPairs = 'Aml\\Fpl\\toPairs';
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
const useWith = 'Aml\\Fpl\\useWith';
/**
 * Values of an iterable
 *
 * @param iterable $items
 * @return iterable
 */
const values = 'Aml\\Fpl\\values';
/**
 * Zips one or more iterables
 *
 * @param iterable $first
 * @param iterable[] ...$rest
 * @return iterable
 */
const zip = 'Aml\\Fpl\\zip';
/**
 * Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function all()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\all')(...func_get_args());
}
/**
 * Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function any()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\any')(...func_get_args());
}
/**
 * Groups items in chunks of size `$size`. Note that keys are lost in the process.
 *
 * @param integer $size
 * @param iterable $items
 * @return iterable
 */
function chunk()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\chunk')(...func_get_args());
}
/**
 * Returns a function that negates the result of calling its argument.
 * 
 * @param callable $function
 * @return callable
 */
function complement()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\complement')(...func_get_args());
}
/**
 * Function composition
 * 
 * @param callable[] $function
 * @return callable
 */
function compose()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\compose')(...func_get_args());
}
/**
 * Instantiates/constructs an instance of `$class` with the specified arguments.
 *
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
function construct()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\construct')(...func_get_args());
}
/**
 * Generates integers from `$from` to `$to` with a step of `$step`.
 * Similar to range() but as a generator.
 *
 * @param integer $from
 * @param integer $to
 * @param integer $step
 * @return iterable
 */
function counter()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\counter')(...func_get_args());
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
function curry()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\curry')(...func_get_args());
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
function curryN()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\curryN')(...func_get_args());
}
/**
 * Drops items from `$items` until `$function($item)` is false.
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function dropWhile()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\dropWhile')(...func_get_args());
}
/**
 * Runs a callback over each item in `$items`.
 * Returns the same `$items` iterable, which might be useful for chaining.
 * 
 * @param callable $callback
 * @param iterable $items
 * @return iterable
 */
function each()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\each')(...func_get_args());
}
/**
 * Filters items that do not return a truthy value for `$function`
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function filter()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\filter')(...func_get_args());
}
/**
 * Flattens an iterable up to depth `$depth`. Keys are not preserved.
 * You can perform a full flatten by using flatten(INF).
 *
 * @param number $depth
 * @param iterable $items
 * @return iterable
 */
function flatten()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\flatten')(...func_get_args());
}
/**
 * Flips the first two arguments of a function
 *
 * @param callable $function
 * @return callable
 */
function flip()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\flip')(...func_get_args());
}
/**
 * Builds an associative iterable based on an iterable of pairs.
 * 
 * ```
 * fromPairs([['a', 1], ['b', 2]]); // ['a' => 1, 'b' => 2]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return iterable
 */
function fromPairs()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\fromPairs')(...func_get_args());
}
/**
 * Groups each item `$item` in `$items` by the value provided by `$grouper($item)`.
 * 
 * ```
 * $grouped = groupBy(index('age'), [
 *      ['name' => 'Pete', 'age' => 30],
 *      ['name' => 'Carl', 'age' => 25],
 *      ['name' => 'Martha', 'age' => 30],
 * ]);
 * ```
 * 
 * Results in the following array:
 * ```
 * [
 *  30 => [
 *      ['name' => 'Pete', 'age' => 30],
 *      ['name' => 'Martha', 'age' => 30],
 *  ],
 *  25 => [
 *      ['name' => 'Carl', 'age' => 25],
 *  ],
 * ]
 * ```
 * 
 * @param callable $grouper
 * @param iterable $items
 * @return iterable
 */
function groupBy()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\groupBy')(...func_get_args());
}
/**
 * Returns the first element in `$items`, if any
 *
 * @param iterable $items
 * @return mixed
 */
function head()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\head')(...func_get_args());
}
/**
 * Returns its sole argument as is.
 * 
 * Useful as a placeholder filter; e.g.:
 * ```
 * any(identity, [0, 1, 2]);    // [1, 2]
 * ```
 *
 * @param mixed $item
 * @return mixed
 */
function identity()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\identity')(...func_get_args());
}
/**
 * Accesses `$array` at its position `$index`.
 *
 * @param mixed $index
 * @param array|\ArrayAccess $array
 * @return mixed
 */
function index()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\index')(...func_get_args());
}
/**
 * Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
 *
 * @param mixed $index
 * @param mixed $else
 * @param array|\ArrayAccess $array
 * @return void
 */
function indexOr()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\indexOr')(...func_get_args());
}
/**
 * Returns a callable that will invoke $method on its sole argument, with the specified `$args`
 * 
 * Assuming `$Pete`, `$Carl` are instances of `Person`, which defines a method `getAge()`:
 * map(invoker('getAge'), [$Pete, $Carl]);  // [30, 25]
 *
 * @param string $method
 * @param mixed[] ...$args
 * @return callable
 */
function invoker()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\invoker')(...func_get_args());
}
/**
 * Returns the keys of `$items`
 *
 * @param iterable $items
 * @return iterable
 */
function keys()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\keys')(...func_get_args());
}
/**
 * Returns the last item in `$items`, if any
 *
 * @param iterable $items
 * @return mixed
 */
function last()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\last')(...func_get_args());
}
/**
 * Maps `$items` with `$function`
 * 
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function map()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\map')(...func_get_args());
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
function nAry()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\nAry')(...func_get_args());
}
/**
 * Filters `$items` by keys that do NOT belong in `$keys`.
 * 
 * ```
 * omit(['password'], ['name' => 'Pete', 'password' => 'secret']); // ['name' => 'Pete]
 * ```
 *
 * @param array $indices
 * @param iterable $items
 * @return iterable
 */
function omit()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\omit')(...func_get_args());
}
/**
 * Filters `$items` by those who do not pass `$function`.
 * 
 * ```
 * omitBy(index('admin'), [
 *     ['name' => 'Pete', 'admin' => true],
 *     ['name' => 'Carl', 'admin' => false],
 * ]);
 * ```
 * 
 * Would result in:
 * ```
 * [
 *     ['name' => 'Carl', 'admin' => false],
 * ]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function omitBy()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\omitBy')(...func_get_args());
}
/**
 * Partial application
 *
 * @param callable $function
 * @param mixed ...$partialArgs
 * @return callable
 */
function partial()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\partial')(...func_get_args());
}
/**
 * Filters `$items` by keys that belong in `$keys`.
 * 
 * ```
 * pick(['age'], ['age' => 30, 'name' => 'Pete']); // ['age' => 30]
 * ```
 *
 * @param array $indices
 * @param iterable $items
 * @return iterable
 */
function pick()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\pick')(...func_get_args());
}
/**
 * Filters `$items` that pass the specified `$function`.
 * This function is equivalent to `filter`
 * 
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function pickBy()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\pickBy')(...func_get_args());
}
/**
 * Function piping. Equivalent to composing with reversed order.
 *
 * @param callable[] ...$functions
 * @return callable
 */
function pipe()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\pipe')(...func_get_args());
}
/**
 * Attempts to get property `$property` from object `$object`.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function prop()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\prop')(...func_get_args());
}
/**
 * Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function propOr()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\propOr')(...func_get_args());
}
/**
 * Array reducing, a.k.a. foldl.
 *
 * @param callable $function reducer function
 * @param mixed $initial initial value
 * @param iterable $items
 * @return iterable
 */
function reduce()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\reduce')(...func_get_args());
}
/**
 * Returns the first item in `$items` for which `$callback($item)` is truthy
 *
 * @param callable $callback
 * @param iterable $items
 * @return mixed
 */
function search()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\search')(...func_get_args());
}
/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
 *
 * @param integer $start
 * @param number $length
 * @param iterable $items
 * @return iterable
 */
function slice()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\slice')(...func_get_args());
}
/**
 * Sorts `$items`. Note that return type will be array regardless of `$items`,
 * and the array will be sorted in place, since we use php's `usort`
 *
 * @param callable $comparator function that takes 2 values and returns an integer -1, 0, 1
 * @param iterable $items
 * @return array
 */
function sort()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\sort')(...func_get_args());
}
/**
 * Similar to sort, but using a function that returns a value to use as comparison for each item.
 * 
 * sortBy(index('age'), [
 *     ['name' => 'Pete', 'age' => 30],
 *     ['name' => 'Carl', 'age' => 25],
 * ]);
 * 
 * Would result in:
 * [
 *     ['name' => 'Carl', 'age' => 25],
 *     ['name' => 'Pete', 'age' => 30],
 * ]
 *
 * @param callable $function function that takes an item and returns a value that can be compared with php's spaceship operator <=>
 * @param iterable $items
 * @return array
 */
function sortBy()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\sortBy')(...func_get_args());
}
/**
 * Applies the spaceship operator on its two arguments
 *
 * @param mixed $a
 * @param mixed $b
 * @return integer
 */
function spaceship()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\spaceship')(...func_get_args());
}
/**
 * Takes items from `$items` until `$function($item)` yields false
 *
 * @param callable $function
 * @param iterable $items
 * @return iterable
 */
function takeWhile()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\takeWhile')(...func_get_args());
}
/**
 * Iterable to array
 *
 * @param iterable $items
 * @return iterable
 */
function toArray()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\toArray')(...func_get_args());
}
/**
 * Iterable to iterator
 *
 * @param iterable $items
 * @return iterable
 */
function toIterator()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\toIterator')(...func_get_args());
}
/**
 * From associative iterable to a list of pairs.
 * 
 * ```
 * fromPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return iterable
 */
function toPairs()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\toPairs')(...func_get_args());
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
function useWith()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\useWith')(...func_get_args());
}
/**
 * Values of an iterable
 *
 * @param iterable $items
 * @return iterable
 */
function values()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\values')(...func_get_args());
}
/**
 * Zips one or more iterables
 *
 * @param iterable $first
 * @param iterable[] ...$rest
 * @return iterable
 */
function zip()
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\zip')(...func_get_args());
}