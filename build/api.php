<?php

/* This file was automatically generated */
namespace Aml\Fpl;

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
function complement()
{
    return functions\curry(functions\complement(...))(...func_get_args());
}
/**
 * Instantiates/construct(...),s an instance of `$class` with the specified arguments.
 *
 * ```
 * $makeArrayObject = partial(construct(...), \ArrayObject::class);
 * $makeArrayObject(['a' => 1])->offsetExists('a'); // true
 * ```
 * 
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
function construct()
{
    return functions\curry(functions\construct(...))(...func_get_args());
}
/**
 * `>` operator
 * 
 * ```
 * gt(3, 1); // false
 * gt(3, 3); // false
 * gt('a', 'b'); // true
 * ```
 *
 * @param mixed $cmp
 * @param mixed $value
 * @return boolean
 */
function gt()
{
    return functions\curry(functions\gt(...))(...func_get_args());
}
/**
 * Generates integers from `$from` (included) to `$to` (excluded) with a step of `$step`.
 * Similar to range() but as a generator.
 * 
 * ```
 * counter();   // 0, 1, 2....
 * counter(1, 10, 3);  // 1, 4, 7
 * ```
 *
 * @param integer $from
 * @param integer $to
 * @param integer $step
 * @return iterable
 */
function counter()
{
    return functions\curry(functions\counter(...))(...func_get_args());
}
/**
 * Function composition
 * 
 * ```
 * compose(last(...), slice(1, 3), counter(...))(10); // 13
 * ```
 * 
 * @param callable[] $function
 * @return callable
 */
function compose()
{
    return functions\curry(functions\compose(...))(...func_get_args());
}
/**
 * Returns its sole argument as is.
 * 
 * Useful as a placeholder filter; e.g.:
 * ```
 * any(identity(...), [0, 1, 2]); // true
 * ```
 *
 * @param mixed $item
 * @return mixed
 */
function identity()
{
    return functions\curry(functions\identity(...))(...func_get_args());
}
/**
 * Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 * 
 * ```
 * all(identity(...), [true, 1]); // true
 * all(head(...), [[1, 2], [0, 1]]); // false
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function all()
{
    return functions\curry(functions\all(...))(...func_get_args());
}
/**
 * `>=` operator
 * 
 * ```
 * gte(3, 1); // false
 * gte(3, 3); // true
 * ```
 *
 * @param mixed $cmp
 * @param mixed $value
 * @return boolean
 */
function gte()
{
    return functions\curry(functions\gte(...))(...func_get_args());
}
/**
 * Accesses `$array` at its position `$index`.
 * 
 * ```
 * index(1, [1, 2, 3]); // 2
 * index('a', new \ArrayObject(['a' => 3])); // 3
 * ```
 *
 * @param mixed $index
 * @param array|\ArrayAccess $array
 * @return mixed
 */
function index()
{
    return functions\curry(functions\index(...))(...func_get_args());
}
/**
 * Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 * 
 * ```
 * any(identity(...), [0, 1, 2]); // true
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function any()
{
    return functions\curry(functions\any(...))(...func_get_args());
}
/**
 * `<` operator
 * 
 * ```
 * lt(3, 1); // true
 * lt(3, 3); // false
 * ```
 *
 * @param mixed $cmp
 * @param mixed $value
 * @return boolean
 */
function lt()
{
    return functions\curry(functions\lt(...))(...func_get_args());
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
    return functions\curry(functions\curry(...))(...func_get_args());
}
/**
 * Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
 * 
 * ```
 * indexOr(1, 'foo', [1, 2, 3]); // 2
 * indexOr(4, 'foo', [1, 2, 3]); // 'foo'
 * ```
 *
 * @param mixed $index
 * @param mixed $else
 * @param array|\ArrayAccess $array
 * @return void
 */
function indexOr()
{
    return functions\curry(functions\indexOr(...))(...func_get_args());
}
/**
 * `<=` operator
 * 
 * ```
 * lte(3, 1); // true
 * lte(3, 3); // true
 * ```
 *
 * @param mixed $cmp
 * @param mixed $value
 * @return boolean
 */
function lte()
{
    return functions\curry(functions\lte(...))(...func_get_args());
}
/**
 * Groups items in chunks of size `$size`. Note that keys are lost in the process.
 * 
 * ```
 * chunk(2, [0, 1, 2]); // [[0, 1], [2]]
 * ```
 *
 * @param integer $size
 * @param iterable $items
 * @return array|iterable
 */
function chunk()
{
    return functions\curry(functions\chunk(...))(...func_get_args());
}
/**
 * `===` operator
 * 
 * ```
 * eq(3, 3); // true
 * eq(3, '3'); // false
 * ```
 *
 * @param number $cmp
 * @param number $value
 * @return boolean
 */
function eq()
{
    return functions\curry(functions\eq(...))(...func_get_args());
}
/**
 * Attempts to get property `$property` from object `$object`.
 * Works with magic properties too.
 * 
 * ```
 * $object = new \stdClass();
 * $object->a = 1;
 * prop('a', $object); // 1
 * ```
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function prop()
{
    return functions\curry(functions\prop(...))(...func_get_args());
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
    return functions\curry(functions\curryN(...))(...func_get_args());
}
/**
 * Drops items from `$items` until `$function($item)` is false.
 * 
 * ```
 * dropWhile(identity(...), [0, 1, 2, 0]); // [1, 2, 0]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function dropWhile()
{
    return functions\curry(functions\dropWhile(...))(...func_get_args());
}
/**
 * `!` operator
 * 
 * ```
 * not(1); // false
 * not(''); // true
 * ```
 *
 * @param mixed $cmp
 * @return boolean
 */
function not()
{
    return functions\curry(functions\not(...))(...func_get_args());
}
/**
 * Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
 * 
 * ```
 * $object = new \stdClass();
 * $object->a = 1;
 * $object->b = null;
 * propOr('a', 'foo', $object); // 1
 * propOr('b', 'foo', $object); // 'foo'
 * propOr('c', 'foo', $object); // 'foo'
 * ```
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function propOr()
{
    return functions\curry(functions\propOr(...))(...func_get_args());
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
function flip()
{
    return functions\curry(functions\flip(...))(...func_get_args());
}
/**
 * Applies the spaceship operator on its two arguments
 * 
 * ```
 * spaceship(1, 3); // -1
 * spaceship(1, 1); // 0
 * spaceship(3, 1); // 1
 * spaceship('b', 'a'); // 1
 * ```
 *
 * @param mixed $a
 * @param mixed $b
 * @return integer
 */
function spaceship()
{
    return functions\curry(functions\spaceship(...))(...func_get_args());
}
/**
 * Runs a callback over each item in `$items`.
 * Returns the same `$items` iterable, which might be useful for chaining.
 * 
 * ```
 * $number = 4;
 * $addToNumber = function($z) use(&$number) {
 *     $number += $z;
 * };
 * each($addToNumber, [1, 2, 3]); // [1, 2, 3]
 * $number; // 10
 * ```
 * 
 * @param callable $callback
 * @param iterable $items
 * @return array|iterable
 */
function each()
{
    return functions\curry(functions\each(...))(...func_get_args());
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
function invoker()
{
    return functions\curry(functions\invoker(...))(...func_get_args());
}
/**
 * Flattens an iterable up to depth `$depth`. Keys are not preserved.
 * You can perform a full flatten by using `flatten(INF)`.
 * 
 * ```
 * $array = [1, [2, [3, 4]]];
 * flatten(1, $array); // [1, 2, [3, 4]]
 * flatten(INF, $array); // [1, 2, 3, 4]
 * ```
 *
 * @param number $depth
 * @param iterable $items
 * @return array|iterable
 */
function flatten()
{
    return functions\curry(functions\flatten(...))(...func_get_args());
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
function nAry()
{
    return functions\curry(functions\nAry(...))(...func_get_args());
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
function pack()
{
    return functions\curry(functions\pack(...))(...func_get_args());
}
/**
 * Filters items that do not return a truthy value for `$function`
 * 
 * ```
 * filter(identity(...), [false, null, 1, 0]); // [1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function filter()
{
    return functions\curry(functions\filter(...))(...func_get_args());
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
function partial()
{
    return functions\curry(functions\partial(...))(...func_get_args());
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
 * @return array|iterable
 */
function fromPairs()
{
    return functions\curry(functions\fromPairs(...))(...func_get_args());
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
function pipe()
{
    return functions\curry(functions\pipe(...))(...func_get_args());
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
function unpack()
{
    return functions\curry(functions\unpack(...))(...func_get_args());
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
 * @return array|iterable
 */
function groupBy()
{
    return functions\curry(functions\groupBy(...))(...func_get_args());
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
    return functions\curry(functions\useWith(...))(...func_get_args());
}
/**
 * Returns the first element in `$items`, if any
 * 
 * ```
 * head([1, 2, 3]); // 1
 * head(counter(4)); // 4
 * ```
 *
 * @param iterable $items
 * @return mixed
 */
function head()
{
    return functions\curry(functions\head(...))(...func_get_args());
}
/**
 * Returns the keys of `$items`
 * 
 * ```
 * keys(['a' => 1, 'b' => 2]); // ['a', 'b']
 * ```
 * 
 * @param iterable $items
 * @return array|iterable
 */
function keys()
{
    return functions\curry(functions\keys(...))(...func_get_args());
}
/**
 * Returns the last item in `$items`, if any
 * 
 * ```
 * last([1, 2, 3]); // 3
 * last(counter(4, 6)); // 5
 * ```
 *
 * @param iterable $items
 * @return mixed
 */
function last()
{
    return functions\curry(functions\last(...))(...func_get_args());
}
/**
 * Maps `$items` with `$function`
 * 
 * ```
 * map(head(...), [[0, 1], [2, 3]]); // [0, 2]
 * ```
 * 
 * The index is supplied to the callback. If you want to provide a callback
 * that can't take more than one argument, you can use `nAry`:
 * 
 * ```
 * map('array_sum', [[1, 2], [3, 4]]); // array_sum() expects exactly 1 parameter, 2 given
 * map(nAry(1, 'array_sum'), [[1, 2], [3, 4]]); // [3, 7]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function map()
{
    return functions\curry(functions\map(...))(...func_get_args());
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
 * @return array|iterable
 */
function pick()
{
    return functions\curry(functions\pick(...))(...func_get_args());
}
/**
 * Filters `$items` that pass the specified `$function`.
 * This function is equivalent to `filter`
 * 
 * ```
 * pickBy(head(...), [[0, 1], [2, 3], [4, 5]]); // [[2, 3], [4, 5]]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function pickBy()
{
    return functions\curry(functions\pickBy(...))(...func_get_args());
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
 * @return array|iterable
 */
function omit()
{
    return functions\curry(functions\omit(...))(...func_get_args());
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
 * @return array|iterable
 */
function omitBy()
{
    return functions\curry(functions\omitBy(...))(...func_get_args());
}
/**
 * Array reducing, a.k.a. foldl.
 * 
 * ```
 * reduce(pack('array_sum'), 100, [1, 2, 3]); // 106
 * ```
 *
 * @param callable $function reducer function
 * @param mixed $initial initial value
 * @param iterable $items
 * @return mixed
 */
function reduce()
{
    return functions\curry(functions\reduce(...))(...func_get_args());
}
/**
 * Returns the first item in `$items` for which `$callback($item)` is truthy
 * 
 * ```
 * search(function($value) { return $value > 0; }, [-1, 0, 1, 2]); // 1
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return mixed
 */
function search()
{
    return functions\curry(functions\search(...))(...func_get_args());
}
/**
 * Sorts `$items`. Note that return type will be array regardless of `$items`,
 * and the array will be sorted in place, since we use php's `usort`
 * 
 * ```
 * $sortByName = function($a, $b) {
 *     return $a['name'] <=> $b['name'];
 * };
 * $sorted = sort($sortByName, [
 *     ['name' => 'Pete', 'age' => 30],
 *     ['name' => 'Carl', 'age' => 25],
 * ]);
 * ```
 * 
 * Results in:
 * ```
 * [
 *     ['name' => 'Carl', 'age' => 25],
 *     ['name' => 'Pete', 'age' => 30],
 * ]
 * ```
 *
 * @param callable $comparator function that takes 2 values and returns an integer -1, 0, 1
 * @param iterable $items
 * @return array
 */
function sort()
{
    return functions\curry(functions\sort(...))(...func_get_args());
}
/**
 * Similar to sort, but using a function that returns a value to use as comparison for each item.
 * 
 * ```
 * sortBy(index('age'), [
 *     ['name' => 'Pete', 'age' => 30],
 *     ['name' => 'Carl', 'age' => 25],
 * ]);
 * ```
 * 
 * Would result in:
 * ```
 * [
 *     ['name' => 'Carl', 'age' => 25],
 *     ['name' => 'Pete', 'age' => 30],
 * ]
 * ```
 *
 * @param callable $function function that takes an item and returns a value that can be compared with php's spaceship operator <=>
 * @param iterable $items
 * @return array
 */
function sortBy()
{
    return functions\curry(functions\sortBy(...))(...func_get_args());
}
/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
 * 
 * ```
 * slice(1, 3, range(0, 5)); // [1 => 1, 2 => 2, 3 => 3]
 * ```
 * 
 * @param integer $start
 * @param integer $length
 * @param iterable $items
 * @return array|iterable
 */
function slice()
{
    return functions\curry(functions\slice(...))(...func_get_args());
}
/**
 * Takes items from `$items` until `$function($item)` yields false
 * 
 * ```
 * takeWhile(identity(...), [3, 2, 1, 0, 1, 2, 3])); // [3, 2, 1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function takeWhile()
{
    return functions\curry(functions\takeWhile(...))(...func_get_args());
}
/**
 * Iterable to array
 *
 * @param iterable $items
 * @return array
 */
function toArray()
{
    return functions\curry(functions\toArray(...))(...func_get_args());
}
/**
 * Iterable to iterator
 *
 * @param iterable $items
 * @return iterable
 */
function toIterator()
{
    return functions\curry(functions\toIterator(...))(...func_get_args());
}
/**
 * From associative iterable to a list of pairs.
 * 
 * ```
 * toPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return array|iterable
 */
function toPairs()
{
    return functions\curry(functions\toPairs(...))(...func_get_args());
}
/**
 * Values of an iterable
 * 
 * ```
 * values(['a' => 1, 'b' => 2]); // [1, 2]
 * ```
 *
 * @param iterable $items
 * @return array|iterable
 */
function values()
{
    return functions\curry(functions\values(...))(...func_get_args());
}
/**
 * Zips one or more iterables.
 * If no arguments are provided, an empty array is returned.
 * If at least one argument is provided, the result will be an array or an iterator depending
 * on whether the first argument is an array or an iterator, respectively.
 * 
 * The resulting zipped iterable is as short as the shortest input iterator.
 * 
 * `zip` is equivalent to `zipWith(function(...$args) { return $args; })`.
 * 
 * ```
 * zip(); // []
 * zip([1, 3, 5], [2, 4]); // [[1, 2], [3, 4]]
 * head(zip(counter(1), counter(2), counter(3))); // [1, 2, 3]
 * ```
 *
 * @param iterable[] ...$rest
 * @return array|iterable
 */
function zip()
{
    return functions\curry(functions\zip(...))(...func_get_args());
}
/**
 * Zips one or more iterables with the specified function.
 * If no arguments are provided, an empty array is returned.
 * If at least one argument is provided, the result will be an array or an iterator depending
 * on whether the first argument is an array or an iterator, respectively.
 * 
 * The resulting zipped iterable is as short as the shortest input iterator.
 * 
 * ```
 * $sum = function(...$args) { return array_sum($args); }; // alternatively, $sum = pack('array_sum');
 * zipWith($sum); // []
 * zipWith($sum, [1, 3, 5], [2, 4, 6], [10, 10]); // [13, 17]
 * ```
 *
 * @param callable $function
 * @param iterable[] ...$args
 * @return array|iterable
 */
function zipWith()
{
    return functions\curry(functions\zipWith(...))(...func_get_args());
}