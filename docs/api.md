#### `all(callable $callback, iterable $items) : bool`

Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
You can use `identity` to filter by the items themselves.
```php
all(identity, [true, 1]); // true
all(head, [[1, 2], [0, 1]]); // false
```
#
#### `any(callable $callback, iterable $items) : bool`

Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
You can use `identity` to filter by the items themselves.
```php
any(identity, [0, 1, 2]); // true
```
#
#### `chunk(int $size, iterable $items) : iterable`

Groups items in chunks of size `$size`. Note that keys are lost in the process.
```php
chunk(2, [0, 1, 2]); // [[0, 1], [2]]
```
#
#### `complement(callable $function) : callable`

Returns a function that negates the result of calling its argument.
```php
$isEven = function($x) { return $x % 2 === 0; };
$isOdd = complement($isEven);
```
#
#### `compose(...$functions) : callable`

Function composition
```php
compose(last, slice(1, 3), counter)(10); // 13
```
#
#### `construct($class, ...$args)`

Instantiates/constructs an instance of `$class` with the specified arguments.
```php
$makeArrayObject = partial(construct, \ArrayObject::class);
$makeArrayObject(['a' => 1])->offsetExists('a'); // true
```
#
#### `counter(int $from = 0, $to = INF, int $step = 1) : iterable`

Generates integers from `$from` (included) to `$to` (excluded) with a step of `$step`.
Similar to range() but as a generator.
```php
counter();   // 0, 1, 2....
counter(1, 10, 3);  // 1, 4, 7
```
#
#### `curry(callable $function) : callable`

Returns the curried version of a function.
Once all non-optional, non-variadic parameters have been provided, the function will be called;
if you need to curry optional or variadic parameters you must use curryN and specify the number of parameters.
```php
$add2AndMore = function($a, $b, ...$rest) {
    return $a + $b + array_sum($rest);
};
$curried = curry($add2AndMore);
$curried()(1)(2);    // 3
$curried(1)(2);      // 3
$curried(1, 2);      // 3
$curried(1, 2, 3);   // 6
$curried(1, 2)(3);   // error! calling 3(3)
```
#
#### `curryN(int $N, callable $function) : callable`

Curries exactly `$N` parameters of the given function:
```php
$add2AndMore = function($a, $b, ...$rest) {
    return $a + $b + array_sum($rest);
};
$curried = curryN(4, $add2AndMore);
$curried(1, 2);          // callable
$curried(1, 2, 3);       // callable
$curried(1, 2, 3, 4);    // 10
```
#
#### `dropWhile(callable $function, iterable $items) : iterable`

Drops items from `$items` until `$function($item)` is false.
```php
dropWhile(identity, [0, 1, 2, 0]); // [1, 2, 0]
```
#
#### `each(callable $callback, iterable $items) : iterable`

Runs a callback over each item in `$items`.
Returns the same `$items` iterable, which might be useful for chaining.
```php
$number = 4;
$addToNumber = function($z) use(&$number) {
    $number += $z;
};
each($addToNumber, [1, 2, 3]); // [1, 2, 3]
$number; // 10
```
#
#### `eq($cmp, $value) : bool`

`===` operator
```php
eq(3, 3); // true
eq(3, '3'); // false
```
#
#### `filter(callable $function, iterable $items) : iterable`

Filters items that do not return a truthy value for `$function`
```php
filter(identity, [false, null, 1, 0]); // [1]
```
#
#### `flatten($depth, iterable $items) : iterable`

Flattens an iterable up to depth `$depth`. Keys are not preserved.
You can perform a full flatten by using `flatten(INF)`.
```php
$array = [1, [2, [3, 4]]];
flatten(1, $array); // [1, 2, [3, 4]]
flatten(INF, $array); // [1, 2, 3, 4]
```
#
#### `flip(callable $function) : callable`

Flips the first two arguments of a function
```php
$prepend = flip('array_merge');
$prepend([1], [2], [3]]); // [2, 1, 3]
```
#
#### `fromPairs(iterable $items) : iterable`

Builds an associative iterable based on an iterable of pairs.
```php
fromPairs([['a', 1], ['b', 2]]); // ['a' => 1, 'b' => 2]
```
This is the inverse of `toPairs`.
#
#### `groupBy(callable $grouper, iterable $items) : iterable`

Groups each item `$item` in `$items` by the value provided by `$grouper($item)`.
```php
$grouped = groupBy(index('age'), [
     ['name' => 'Pete', 'age' => 30],
     ['name' => 'Carl', 'age' => 25],
     ['name' => 'Martha', 'age' => 30],
]);
```
Results in the following array:
```php
[
 30 => [
     ['name' => 'Pete', 'age' => 30],
     ['name' => 'Martha', 'age' => 30],
 ],
 25 => [
     ['name' => 'Carl', 'age' => 25],
 ],
]
```
#
#### `gt($cmp, $value) : bool`

`>` operator
```php
gt(3, 1); // false
gt(3, 3); // false
gt('a', 'b'); // true
```
#
#### `gte($cmp, $value) : bool`

`>=` operator
```php
gte(3, 1); // false
gte(3, 3); // true
```
#
#### `head(iterable $items)`

Returns the first element in `$items`, if any
```php
head([1, 2, 3]); // 1
head(counter(4)); // 4
```
#
#### `identity($item)`

Returns its sole argument as is.
Useful as a placeholder filter; e.g.:
```php
any(identity, [0, 1, 2]); // true
```
#
#### `index($index, $array)`

Accesses `$array` at its position `$index`.
```php
index(1, [1, 2, 3]); // 2
index('a', new \ArrayObject(['a' => 3])); // 3
```
#
#### `indexOr($index, $else, $array)`

Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
```php
indexOr(1, 'foo', [1, 2, 3]); // 2
indexOr(4, 'foo', [1, 2, 3]); // 'foo'
```
#
#### `invoker(string $method, ...$args) : callable`

Returns a callable that will invoke `$method` on its sole argument, with the specified `$args`
```php
// assuming that Pete and Carl are aged 30 and 25 respectively, and
// that $Pete and $Carl are instances of Person, which defines a method getAge():
map(invoker('getAge'), [$Pete, $Carl]);  // [30, 25]
```
#
#### `keys(iterable $items) : iterable`

Returns the keys of `$items`
```php
keys(['a' => 1, 'b' => 2]); // ['a', 'b']
```
#
#### `last(iterable $items)`

Returns the last item in `$items`, if any
```php
last([1, 2, 3]); // 3
last(counter(4, 6)); // 5
```
#
#### `lt($cmp, $value) : bool`

`<` operator
```php
lt(3, 1); // true
lt(3, 3); // false
```
#
#### `lte($cmp, $value) : bool`

`<=` operator
```php
lte(3, 1); // true
lte(3, 3); // true
```
#
#### `map(callable $function, iterable $items) : iterable`

Maps `$items` with `$function`
```php
map(head, [[0, 1], [2, 3]]); // [0, 2]
```
The index is supplied to the callback. If you want to provide a callback
that can't take more than one argument, you can use `nAry`:
```php
map('array_sum', [[1, 2], [3, 4]]); // array_sum() expects exactly 1 parameter, 2 given
map(nAry(1, 'array_sum'), [[1, 2], [3, 4]]); // [3, 7]
```
#
#### `nAry(int $arity, callable $function) : callable`

Transforms a function into a fixed arity.
```php
map('get_class', $items); // Error: get_class expected at most 1 parameter but 2 were given
map(nAry(1, 'get_class'), $items); // [...]
```
#
#### `not($cmp) : bool`

`!` operator
```php
not(1); // false
not(''); // true
```
#
#### `omit(array $indices, iterable $items) : iterable`

Filters `$items` by keys that do NOT belong in `$keys`.
```php
omit(['password'], ['name' => 'Pete', 'password' => 'secret']); // ['name' => 'Pete]
```
#
#### `omitBy(callable $function, iterable $items) : iterable`

Filters `$items` by those who do not pass `$function`.
```php
omitBy(index('admin'), [
    ['name' => 'Pete', 'admin' => true],
    ['name' => 'Carl', 'admin' => false],
]);
```
Would result in:
```php
[
    ['name' => 'Carl', 'admin' => false],
]
```
#
#### `pack(callable $function) : callable`

Packs the arguments of a function into an tuple/array
```php
$sum = pack('array_sum');
$sum(1, 2, 3); // 6
```
#
#### `partial(callable $function, ...$partialArgs) : callable`

Partial application
```php
$prepend1 = partial('array_merge', [1]);
$prepend1([2, 3]); // [1, 2, 3]
```
#
#### `pick(array $keys, iterable $items) : iterable`

Filters `$items` by keys that belong in `$keys`.
```php
pick(['age'], ['age' => 30, 'name' => 'Pete']); // ['age' => 30]
```
#
#### `pickBy(callable $function, iterable $items) : iterable`

Filters `$items` that pass the specified `$function`.
This function is equivalent to `filter`
```php
pickBy(head, [[0, 1], [2, 3], [4, 5]]); // [[2, 3], [4, 5]]
```
#
#### `pipe(...$functions) : callable`

Function piping. Equivalent to composing with reversed order.
```php
pipe(counter, head)(3); // 3
```
#
#### `prop(string $property, $object)`

Attempts to get property `$property` from object `$object`.
Works with magic properties too.
```php
$object = new \stdClass();
$object->a = 1;
prop('a', $object); // 1
```
#
#### `propOr(string $property, $else, $object)`

Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
```php
$object = new \stdClass();
$object->a = 1;
$object->b = null;
propOr('a', 'foo', $object); // 1
propOr('b', 'foo', $object); // 'foo'
propOr('c', 'foo', $object); // 'foo'
```
#
#### `reduce(callable $function, $initial, iterable $items)`

Array reducing, a.k.a. foldl.
```php
reduce(pack('array_sum'), 100, [1, 2, 3]); // 106
```
#
#### `search(callable $callback, iterable $items)`

Returns the first item in `$items` for which `$callback($item)` is truthy
```php
search(function($value) { return $value > 0; }, [-1, 0, 1, 2]); // 1
```
#
#### `slice(int $start, $length, iterable $items) : iterable`

Returns a slice of `$items`, beginning at `$start` and of length `$length`.
```php
slice(1, 3, range(0, 5)); // [1 => 1, 2 => 2, 3 => 3]
```
#
#### `sort(callable $comparator, iterable $items) : array`

Sorts `$items`. Note that return type will be array regardless of `$items`,
and the array will be sorted in place, since we use php's `usort`
```php
$sortByName = function($a, $b) {
    return $a['name'] <=> $b['name'];
};
$sorted = sort($sortByName, [
    ['name' => 'Pete', 'age' => 30],
    ['name' => 'Carl', 'age' => 25],
]);
```
Results in:
```php
[
    ['name' => 'Carl', 'age' => 25],
    ['name' => 'Pete', 'age' => 30],
]
```
#
#### `sortBy(callable $function, iterable $items) : array`

Similar to sort, but using a function that returns a value to use as comparison for each item.
```php
sortBy(index('age'), [
    ['name' => 'Pete', 'age' => 30],
    ['name' => 'Carl', 'age' => 25],
]);
```
Would result in:
```php
[
    ['name' => 'Carl', 'age' => 25],
    ['name' => 'Pete', 'age' => 30],
]
```
#
#### `spaceship($a, $b) : int`

Applies the spaceship operator on its two arguments
```php
spaceship(1, 3); // -1
spaceship(1, 1); // 0
spaceship(3, 1); // 1
spaceship('b', 'a'); // 1
```
#
#### `takeWhile(callable $function, iterable $items) : iterable`

Takes items from `$items` until `$function($item)` yields false
```php
takeWhile(identity, [3, 2, 1, 0, 1, 2, 3])); // [3, 2, 1]
```
#
#### `toArray(iterable $items) : array`

Iterable to array
#
#### `toIterator(iterable $items) : iterable`

Iterable to iterator
#
#### `toPairs(iterable $items) : iterable`

From associative iterable to a list of pairs.
```php
toPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
```
This is the inverse of `toPairs`.
#
#### `unpack(callable $function) : callable`

Unpacks/spreads arguments of a function
```php
$words = compose(
    unpack('array_merge'),
    map(nAry(1, partial('explode', ' ')))
);
$words(['a sentence', 'some other sentence']); // ['a', 'sentence', 'some', 'other', 'sentence']
```
#
#### `useWith(array $argCallbacks, callable $function) : callable`

Wraps a function `$function` so that it's called with transformed arguments, as defined
by the `$argCallbacks` array.
```php
$mergeFirst2 = useWith([slice(0, 2), slice(0, 2)], 'array_merge');
$mergeFirst2([1,2,3,4], [5,6,7,8]);  // [1,2,5,6]
```
#
#### `values(iterable $items) : iterable`

Values of an iterable
```php
values(['a' => 1, 'b' => 2]); // [1, 2]
```
#
#### `zip(...$args) : iterable`

Zips one or more iterables.
If no arguments are provided, an empty array is returned.
If at least one argument is provided, the result will be an array or an iterator depending
on whether the first argument is an array or an iterator, respectively.
The resulting zipped iterable is as short as the shortest input iterator.
`zip` is equivalent to `zipWith(function(...$args) { return $args; })`.
```php
zip(); // []
zip([1, 3, 5], [2, 4]); // [[1, 2], [3, 4]]
head(zip(counter(1), counter(2), counter(3))); // [1, 2, 3]
```
#
#### `zipWith(callable $function, ...$args) : iterable`

Zips one or more iterables with the specified function.
If no arguments are provided, an empty array is returned.
If at least one argument is provided, the result will be an array or an iterator depending
on whether the first argument is an array or an iterator, respectively.
The resulting zipped iterable is as short as the shortest input iterator.
```php
$sum = function(...$args) { return array_sum($args); }; // alternatively, $sum = pack('array_sum');
zipWith($sum); // []
zipWith($sum, [1, 3, 5], [2, 4, 6], [10, 10]); // [13, 17]
```