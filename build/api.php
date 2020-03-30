<?php

/* This file was automatically generated */
namespace Aml\Fpl;

/**
 * Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 * 
 * ```
 * all(identity, [true, 1]); // true
 * all(head, [[1, 2], [0, 1]]); // false
 * ```
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
 * ```
 * any(identity, [0, 1, 2]); // true
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
const any = 'Aml\\Fpl\\any';
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
const chunk = 'Aml\\Fpl\\chunk';
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
const complement = 'Aml\\Fpl\\complement';
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
const compose = 'Aml\\Fpl\\compose';
/**
 * Instantiates/constructs an instance of `$class` with the specified arguments.
 *
 * ```
 * $makeArrayObject = partial(construct, \ArrayObject::class);
 * $makeArrayObject(['a' => 1])->offsetExists('a'); // true
 * ```
 * 
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
const construct = 'Aml\\Fpl\\construct';
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
 * ```
 * dropWhile(identity, [0, 1, 2, 0]); // [1, 2, 0]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
const dropWhile = 'Aml\\Fpl\\dropWhile';
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
const each = 'Aml\\Fpl\\each';
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
const eq = 'Aml\\Fpl\\eq';
/**
 * Filters items that do not return a truthy value for `$function`
 * 
 * ```
 * filter(identity, [false, null, 1, 0]); // [1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
const filter = 'Aml\\Fpl\\filter';
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
const flatten = 'Aml\\Fpl\\flatten';
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
 * @return array|iterable
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
 * @return array|iterable
 */
const groupBy = 'Aml\\Fpl\\groupBy';
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
const gt = 'Aml\\Fpl\\gt';
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
const gte = 'Aml\\Fpl\\gte';
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
const head = 'Aml\\Fpl\\head';
/**
 * Returns its sole argument as is.
 * 
 * Useful as a placeholder filter; e.g.:
 * ```
 * any(identity, [0, 1, 2]); // true
 * ```
 *
 * @param mixed $item
 * @return mixed
 */
const identity = 'Aml\\Fpl\\identity';
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
const index = 'Aml\\Fpl\\index';
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
const indexOr = 'Aml\\Fpl\\indexOr';
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
const invoker = 'Aml\\Fpl\\invoker';
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
const keys = 'Aml\\Fpl\\keys';
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
const last = 'Aml\\Fpl\\last';
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
const lt = 'Aml\\Fpl\\lt';
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
const lte = 'Aml\\Fpl\\lte';
/**
 * Maps `$items` with `$function`
 * 
 * ```
 * map(head, [[0, 1], [2, 3]]); // [0, 2]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
const map = 'Aml\\Fpl\\map';
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
const nAry = 'Aml\\Fpl\\nAry';
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
const not = 'Aml\\Fpl\\not';
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
 * @return array|iterable
 */
const omitBy = 'Aml\\Fpl\\omitBy';
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
const pack = 'Aml\\Fpl\\pack';
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
 * @return array|iterable
 */
const pick = 'Aml\\Fpl\\pick';
/**
 * Filters `$items` that pass the specified `$function`.
 * This function is equivalent to `filter`
 * 
 * ```
 * pickBy(head, [[0, 1], [2, 3], [4, 5]]); // [[2, 3], [4, 5]]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
const pickBy = 'Aml\\Fpl\\pickBy';
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
const pipe = 'Aml\\Fpl\\pipe';
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
const prop = 'Aml\\Fpl\\prop';
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
const propOr = 'Aml\\Fpl\\propOr';
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
const reduce = 'Aml\\Fpl\\reduce';
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
const search = 'Aml\\Fpl\\search';
/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
 * 
 * ```
 * slice(1, 3, range(0, 5)); // [1 => 1, 2 => 2, 3 => 3]
 * ```
 * 
 * @param integer $start
 * @param number $length
 * @param iterable $items
 * @return array|iterable
 */
const slice = 'Aml\\Fpl\\slice';
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
const sort = 'Aml\\Fpl\\sort';
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
const sortBy = 'Aml\\Fpl\\sortBy';
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
const spaceship = 'Aml\\Fpl\\spaceship';
/**
 * Takes items from `$items` until `$function($item)` yields false
 * 
 * ```
 * takeWhile(identity, [3, 2, 1, 0, 1, 2, 3])); // [3, 2, 1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
const takeWhile = 'Aml\\Fpl\\takeWhile';
/**
 * Iterable to array
 *
 * @param iterable $items
 * @return array
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
 * toPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
 * ```
 * 
 * This is the inverse of `toPairs`.
 *
 * @param iterable $items
 * @return array|iterable
 */
const toPairs = 'Aml\\Fpl\\toPairs';
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
const unpack = 'Aml\\Fpl\\unpack';
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
 * ```
 * values(['a' => 1, 'b' => 2]); // [1, 2]
 * ```
 *
 * @param iterable $items
 * @return array|iterable
 */
const values = 'Aml\\Fpl\\values';
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
const zip = 'Aml\\Fpl\\zip';
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
const zipWith = 'Aml\\Fpl\\zipWith';
/**
 * Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 * 
 * ```
 * all(identity, [true, 1]); // true
 * all(head, [[1, 2], [0, 1]]); // false
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function all()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\all')(...func_get_args());
}
/**
 * Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 * 
 * ```
 * any(identity, [0, 1, 2]); // true
 * ```
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function any()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\any')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\chunk')(...func_get_args());
}
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\complement')(...func_get_args());
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
function compose()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\compose')(...func_get_args());
}
/**
 * Instantiates/constructs an instance of `$class` with the specified arguments.
 *
 * ```
 * $makeArrayObject = partial(construct, \ArrayObject::class);
 * $makeArrayObject(['a' => 1])->offsetExists('a'); // true
 * ```
 * 
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
function construct()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\construct')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\counter')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\curry')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\curryN')(...func_get_args());
}
/**
 * Drops items from `$items` until `$function($item)` is false.
 * 
 * ```
 * dropWhile(identity, [0, 1, 2, 0]); // [1, 2, 0]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function dropWhile()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\dropWhile')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\each')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\eq')(...func_get_args());
}
/**
 * Filters items that do not return a truthy value for `$function`
 * 
 * ```
 * filter(identity, [false, null, 1, 0]); // [1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function filter()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\filter')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\flatten')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\flip')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\fromPairs')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\groupBy')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\gt')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\gte')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\head')(...func_get_args());
}
/**
 * Returns its sole argument as is.
 * 
 * Useful as a placeholder filter; e.g.:
 * ```
 * any(identity, [0, 1, 2]); // true
 * ```
 *
 * @param mixed $item
 * @return mixed
 */
function identity()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\identity')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\index')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\indexOr')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\invoker')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\keys')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\last')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\lt')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\lte')(...func_get_args());
}
/**
 * Maps `$items` with `$function`
 * 
 * ```
 * map(head, [[0, 1], [2, 3]]); // [0, 2]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function map()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\map')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\nAry')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\not')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\omit')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\omitBy')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\pack')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\partial')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\pick')(...func_get_args());
}
/**
 * Filters `$items` that pass the specified `$function`.
 * This function is equivalent to `filter`
 * 
 * ```
 * pickBy(head, [[0, 1], [2, 3], [4, 5]]); // [[2, 3], [4, 5]]
 * ```
 * 
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function pickBy()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\pickBy')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\pipe')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\prop')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\propOr')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\reduce')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\search')(...func_get_args());
}
/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
 * 
 * ```
 * slice(1, 3, range(0, 5)); // [1 => 1, 2 => 2, 3 => 3]
 * ```
 * 
 * @param integer $start
 * @param number $length
 * @param iterable $items
 * @return array|iterable
 */
function slice()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\slice')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\sort')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\sortBy')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\spaceship')(...func_get_args());
}
/**
 * Takes items from `$items` until `$function($item)` yields false
 * 
 * ```
 * takeWhile(identity, [3, 2, 1, 0, 1, 2, 3])); // [3, 2, 1]
 * ```
 *
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function takeWhile()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\takeWhile')(...func_get_args());
}
/**
 * Iterable to array
 *
 * @param iterable $items
 * @return array
 */
function toArray()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\toArray')(...func_get_args());
}
/**
 * Iterable to iterator
 *
 * @param iterable $items
 * @return iterable
 */
function toIterator()
{
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\toIterator')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\toPairs')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\unpack')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\useWith')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\values')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\zip')(...func_get_args());
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
    return \Aml\Fpl\functions\curry('\\Aml\\Fpl\\functions\\zipWith')(...func_get_args());
}