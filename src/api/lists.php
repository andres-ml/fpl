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
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function all($callback, iterable $items) : bool
{
    return !any(complement($callback), $items);
}

/**
 * Returns whether any `$item` in `$items` returns a truthy value for `$callback($item)`.
 * You can use `identity` to filter by the items themselves.
 *
 * @param callable $callback
 * @param iterable $items
 * @return boolean
 */
function any($callback, iterable $items) : bool
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
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function dropWhile($function, iterable $items) : iterable
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
 * @param callable $callback
 * @param iterable $items
 * @return array|iterable
 */
function each($callback, iterable $items) : iterable
{
    foreach ($items as $item) {
        $callback($item);
    }
    return $items;
}

/**
 * Flattens an iterable up to depth `$depth`. Keys are not preserved.
 * You can perform a full flatten by using flatten(INF).
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
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function filter($function, iterable $items) : iterable
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
function groupBy($grouper, iterable $items) : iterable
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
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function map($function, iterable $items) : iterable
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
 * @param callable $function reducer function
 * @param mixed $initial initial value
 * @param iterable $items
 * @return mixed
 */
function reduce($function, $initial, iterable $items)
{
    foreach ($items as $item) {
        $initial = $function($initial, $item);
    }
    return $initial;
}

/**
 * Returns the first item in `$items` for which `$callback($item)` is truthy
 *
 * @param callable $callback
 * @param iterable $items
 * @return mixed
 */
function search($callback, iterable $items)
{
    return compose(Fpl\head, Fpl\filter($callback), Fpl\toIterator)($items);
}

/**
 * Sorts `$items`. Note that return type will be array regardless of `$items`,
 * and the array will be sorted in place, since we use php's `usort`
 *
 * @param callable $comparator function that takes 2 values and returns an integer -1, 0, 1
 * @param iterable $items
 * @return array
 */
function sort($comparator, iterable $items) : array
{
    $array = toArray($items);
    usort($array, $comparator);
    return $array;
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
function sortBy($function, iterable $items) : array
{
    return Fpl\sort(Fpl\useWith([$function, $function], Fpl\spaceship), $items);
}

/**
 * Returns a slice of `$items`, beginning at `$start` and of length `$length`.
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
 * @param callable $function
 * @param iterable $items
 * @return array|iterable
 */
function takeWhile($function, iterable $items) : iterable
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