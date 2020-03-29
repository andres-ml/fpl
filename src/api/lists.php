<?php

namespace Aml\Fpl\functions;

use Aml\Fpl;

/**
 * Given an iterator-returning function $generator and a base object,
 * returns the iterator as is if the base object is also an iterator, or
 * an array if the base object is an array
 *
 * @param iterable $base
 * @param callable $generator
 * @return array|iterable
 */
function _arrayOrIterator(iterable $base, callable $generator) : iterable
{
    $result = $generator($base);
    return is_array($base) ? iterator_to_array($result) : $result;
}

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
function all(callable $callback, iterable $items) : bool
{
    return !any(complement($callback), $items);
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
function any(callable $callback, iterable $items) : bool
{
    foreach ($items as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
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
function chunk(int $size, iterable $items) : iterable
{
    return compose(
        // Fpl\values,
        Fpl\groupBy(function($item, $key) use ($size) {
            return (int) $key / $size;
        }),
        Fpl\values
    )($items);
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
function dropWhile(callable $function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        $dropped = false;
        foreach ($items as $key => $value) {
            if (!$dropped && $function($value, $key)) {
                continue;
            }
            $dropped = true;
            yield $key => $value;
        }
    });
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
function each(callable $callback, iterable $items) : iterable
{
    foreach ($items as $item) {
        $callback($item);
    }
    return $items;
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
function flatten($depth, iterable $items) : iterable
{
    $index = 0; // to prevent `yield from` from overriding indices
    $flatten = function($depth, $items) use(&$flatten, &$index) {
        foreach ($items as $value) {
            if (is_iterable($value) && $depth > 0) {
                yield from $flatten($depth - 1, $value);
            }
            else {
                yield $index++ => $value;
            }
        }
    };
    
    return _arrayOrIterator($items, partial($flatten, $depth));
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
function filter(callable $function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            if ($function($value, $key)) {
                yield $key => $value;
            }
        }
    });
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
function fromPairs(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as list($key, $value)) {
            yield $key => $value;
        }
    });
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
function groupBy(callable $grouper, iterable $items) : iterable
{
    $grouped = [];
    foreach ($items as $key => $value) {
        $group = $grouper($value, $key);
        $grouped[$group] []= $value;
    }
    return $grouped;
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
function head(iterable $items)
{
    foreach ($items as $key => $value) {
        return $value;
    }
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
function keys(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $key => $_) {
            yield $key;
        }
    });
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
function last(iterable $items)
{
    if (is_array($items)) {
        return $items[count($items) - 1];
    }
    else {
        foreach ($items as $last);
        return $last;
    }
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
function map(callable $function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            yield $key => $function($value, $key);
        }
    });
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
function pick(array $keys, iterable $items) : iterable
{
    $indexMatch = function($value, $key) use($keys) {
        return in_array($key, $keys);
    };
    return pickBy($indexMatch, $items);
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
function pickBy(callable $function, iterable $items) : iterable
{
    return filter($function, $items);
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
function omit(array $indices, iterable $items) : iterable
{
    $indexMatch = function($value, $key) use($indices) {
        return in_array($key, $indices);
    };
    return omitBy($indexMatch, $items);
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
function omitBy(callable $function, iterable $items) : iterable
{
    return pickBy(complement($function), $items);
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
function reduce(callable $function, $initial, iterable $items)
{
    foreach ($items as $item) {
        $initial = $function($initial, $item);
    }
    return $initial;
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
function search(callable $callback, iterable $items)
{
    return compose(Fpl\head, Fpl\filter($callback), Fpl\toIterator)($items);
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
function sort(callable $comparator, iterable $items) : array
{
    $array = toArray($items);
    usort($array, $comparator);
    return $array;
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
function sortBy(callable $function, iterable $items) : array
{
    return Fpl\sort(Fpl\useWith([$function, $function], Fpl\spaceship), $items);
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
function slice(int $start, $length, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($start, $length) {
        $i = 0;
        foreach ($items as $key => $value) {
            if ($i++ < $start) {
                continue;
            }
            yield $key => $value;
            if ($i >= $start + $length) {
                break;
            }
        }
    });
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
function takeWhile(callable $function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            if (!$function($value, $key)) {
                return;
            }
            yield $key => $value;
        }
    });
}

/**
 * Iterable to array
 *
 * @param iterable $items
 * @return array
 */
function toArray(iterable $items) : array
{
    return is_array($items) ? $items : iterator_to_array($items);
}

/**
 * Iterable to iterator
 *
 * @param iterable $items
 * @return iterable
 */
function toIterator(iterable $items) : iterable
{
    foreach ($items as $key => $value) {
        yield $key => $value;
    }
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
function toPairs(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $key => $value) {
            yield [$key, $value];
        }
    });
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
function values(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $_ => $value) {
            yield $value;
        }
    });
}

/**
 * Zips one or more iterables
 * 
 * ```
 * zip([1, 2], [3, 4]); // [[1, 3], [2, 4]]
 * head(zip(counter(1), counter(2), counter(3))); // [1, 2, 3]
 * ```
 *
 * @param iterable $first
 * @param iterable[] ...$rest
 * @return array|iterable
 */
function zip(iterable $first, ...$rest) : iterable
{
    return _arrayOrIterator($first, function($first) use($rest) {
        $iterators = Fpl\map(Fpl\toIterator, $rest);
        foreach ($first as $key => $value) {
            $row = [$value];
            foreach ($iterators as $iterator) {
                $row []= $iterator->current();
                $iterator->next();
            }
            yield $row;
        }
    });
}