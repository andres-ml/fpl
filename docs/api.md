#### `all(callable $callback, iterable $items) : boolean`

Returns whether every `$item` in `$items` returns a truthy value for `$callback($item)`.
You can use `identity` to filter by the items themselves.
#
#### `any(callable $callback, iterable $items) : boolean`

Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
You can use `identity` to filter by the items themselves.
#
#### `chunk(integer $size, iterable $items) : array|iterable`

Groups items in chunks of size `$size`. Note that keys are lost in the process.
#
#### `complement(callable $function) : callable`

Returns a function that negates the result of calling its argument.
#
#### `compose(callable[] $function) : callable`

Function composition
#
#### `construct(string $class, mixed[] ...$args) : mixed`

Instantiates/constructs an instance of `$class` with the specified arguments.
#
#### `counter(integer $from, integer $to, integer $step) : iterable`

Generates integers from `$from` to `$to` with a step of `$step`.
Similar to range() but as a generator.
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
#### `curryN(integer $N, callable $function) : callable`

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
#### `dropWhile(callable $function, iterable $items) : array|iterable`

Drops items from `$items` until `$function($item)` is false.
#
#### `each(callable $callback, iterable $items) : array|iterable`

Runs a callback over each item in `$items`.
Returns the same `$items` iterable, which might be useful for chaining.
#
#### `filter(callable $function, iterable $items) : array|iterable`

Filters items that do not return a truthy value for `$function`
#
#### `flatten(number $depth, iterable $items) : array|iterable`

Flattens an iterable up to depth `$depth`. Keys are not preserved.
You can perform a full flatten by using flatten(INF).
#
#### `flip(callable $function) : callable`

Flips the first two arguments of a function
#
#### `fromPairs(iterable $items) : array|iterable`

Builds an associative iterable based on an iterable of pairs.
```php
fromPairs([['a', 1], ['b', 2]]); // ['a' => 1, 'b' => 2]
```
This is the inverse of `toPairs`.
#
#### `groupBy(callable $grouper, iterable $items) : array|iterable`

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
 30 => [
     ['name' => 'Pete', 'age' => 30],
     ['name' => 'Martha', 'age' => 30],
 ],
 25 => [
     ['name' => 'Carl', 'age' => 25],
 ],
```
#
#### `head(iterable $items) : mixed`

Returns the first element in `$items`, if any
#
#### `identity(mixed $item) : mixed`

Returns its sole argument as is.
Useful as a placeholder filter; e.g.:
```php
any(identity, [0, 1, 2]);    // [1, 2]
```
#
#### `index(mixed $index, array|\ArrayAccess $array) : mixed`

Accesses `$array` at its position `$index`.
#
#### `indexOr(mixed $index, mixed $else, array|\ArrayAccess $array) : void`

Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
#
#### `invoker(string $method, mixed[] ...$args) : callable`

Returns a callable that will invoke `$method` on its sole argument, with the specified `$args`
```php
// assuming that Pete and Carl are aged 30 and 25 respectively, and
// that $Pete and $Carl are instances of Person, which defines a method getAge():
map(invoker('getAge'), [$Pete, $Carl]);  // [30, 25]
```
#
#### `keys(iterable $items) : array|iterable`

Returns the keys of `$items`
#
#### `last(iterable $items) : mixed`

Returns the last item in `$items`, if any
#
#### `map(callable $function, iterable $items) : array|iterable`

Maps `$items` with `$function`
#
#### `nAry(integer $arity, callable $function) : callable`

Transforms a function into a fixed arity.
```php
map('get_class', $items);            // Error: get_class expected at most 1 parameter but 2 were given
map(nAry(1, 'get_class'), $items);   // [...]
```
#
#### `omit(array $indices, iterable $items) : array|iterable`

Filters `$items` by keys that do NOT belong in `$keys`.
```php
omit(['password'], ['name' => 'Pete', 'password' => 'secret']); // ['name' => 'Pete]
```
#
#### `omitBy(callable $function, iterable $items) : array|iterable`

Filters `$items` by those who do not pass `$function`.
```php
omitBy(index('admin'), [
    ['name' => 'Pete', 'admin' => true],
    ['name' => 'Carl', 'admin' => false],
]);
```
Would result in:
```php
    ['name' => 'Carl', 'admin' => false],
```
#
#### `pack(callable $function) : callable`

Packs the arguments of a function into an tuple/array
```php
$sum = pack('array_sum');
$sum(1, 2, 3);   // 6
```
#
#### `partial(callable $function, mixed ...$partialArgs) : callable`

Partial application
#
#### `pick(array $indices, iterable $items) : array|iterable`

Filters `$items` by keys that belong in `$keys`.
```php
pick(['age'], ['age' => 30, 'name' => 'Pete']); // ['age' => 30]
```
#
#### `pickBy(callable $function, iterable $items) : array|iterable`

Filters `$items` that pass the specified `$function`.
This function is equivalent to `filter`
#
#### `pipe(callable[] ...$functions) : callable`

Function piping. Equivalent to composing with reversed order.
#
#### `prop(string $property, object $object) : mixed`

Attempts to get property `$property` from object `$object`.
#
#### `propOr(string $property, object $object) : mixed`

Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
#
#### `reduce(callable $function, mixed $initial, iterable $items) : array|iterable`

Array reducing, a.k.a. foldl.
#
#### `search(callable $callback, iterable $items) : mixed`

Returns the first item in `$items` for which `$callback($item)` is truthy
#
#### `slice(integer $start, number $length, iterable $items) : array|iterable`

Returns a slice of `$items`, beginning at `$start` and of length `$length`.
#
#### `sort(callable $comparator, iterable $items) : array`

Sorts `$items`. Note that return type will be array regardless of `$items`,
and the array will be sorted in place, since we use php's `usort`
#
#### `sortBy(callable $function, iterable $items) : array`

Similar to sort, but using a function that returns a value to use as comparison for each item.
sortBy(index('age'), [
    ['name' => 'Pete', 'age' => 30],
    ['name' => 'Carl', 'age' => 25],
]);
Would result in:
    ['name' => 'Carl', 'age' => 25],
    ['name' => 'Pete', 'age' => 30],
#
#### `spaceship(mixed $a, mixed $b) : integer`

Applies the spaceship operator on its two arguments
#
#### `takeWhile(callable $function, iterable $items) : array|iterable`

Takes items from `$items` until `$function($item)` yields false
#
#### `toArray(iterable $items) : array`

Iterable to array
#
#### `toIterator(iterable $items) : iterable`

Iterable to iterator
#
#### `toPairs(iterable $items) : array|iterable`

From associative iterable to a list of pairs.
```php
fromPairs(['a' => 1, 'b' => 2]); // [['a', 1], ['b', 2]]
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
#### `values(iterable $items) : array|iterable`

Values of an iterable
#
#### `zip(iterable $first, iterable[] ...$rest) : array|iterable`

Zips one or more iterables