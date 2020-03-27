<?php

namespace Aml\Fpl\functions;

use Aml\Fpl;

function _arrayOrIterator(iterable $base, callable $generator) : iterable
{
    $result = $generator($base);
    return is_array($base) ? iterator_to_array($result) : $result;
}

function all($callback, iterable $items) : bool
{
    return !any($callback, $items);
}

function any($callback, iterable $items) : bool
{
    foreach ($items as $item) {
        if ($callback($item)) {
            return true;
        }
    }
    return false;
}

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

function dropWhile($function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            if ($function($value, $key)) {
                continue;
            }
            yield $key => $value;
        }
    });
}

function each($callback, iterable $items) : iterable
{
    foreach ($items as $item) {
        $callback($item);
    }
    return $items;
}

function flatten($depth, iterable $items) : iterable
{
    $index = 0;
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

function fromPairs(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as list($key, $value)) {
            yield $key => $value;
        }
    });
}

function groupBy($grouper, iterable $items) : iterable
{
    $grouped = [];
    foreach ($items as $key => $value) {
        $group = $grouper($value, $key);
        $grouped[$group] []= $value;
    }
    return $grouped;
}

function head(iterable $items)
{
    foreach ($items as $key => $value) {
        return $value;
    }
}

function keys(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $key => $_) {
            yield $key;
        }
    });
}

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

function map($function, iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            yield $key => $function($value, $key);
        }
    });
}

function pick(array $indices, iterable $items) : iterable
{
    $indexMatch = function($value, $key) use($indices) {
        return in_array($key, $indices);
    };
    return pickBy($indexMatch, $items);
}

function pickBy(callable $function, iterable $items) : iterable
{
    return filter($function, $items);
}

function omit(array $indices, iterable $items) : iterable
{
    $indexMatch = function($value, $key) use($indices) {
        return in_array($key, $indices);
    };
    return omitBy($indexMatch, $items);
}

function omitBy(callable $function, iterable $items) : iterable
{
    return pickBy(complement($function), $items);
}

function reduce($function, $initial, iterable $items) : iterable
{
    foreach ($items as $item) {
        $initial = $function($initial, $item);
    }
    return $initial;
}

function sort($comparator, iterable $items) : array
{
    $array = toArray($items);
    usort($array, $comparator);
    return $array;
}

function sortBy($function, iterable $items) : array
{
    return Fpl\sort(Fpl\useWith([$function, $function], Fpl\spaceship), $items);
}

function search($callback, iterable $items)
{
    return compose(Fpl\head, Fpl\filter($callback), Fpl\toIterator)($items);
}

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

function toArray(iterable $items) : iterable
{
    return is_array($items) ? $items : iterator_to_array($items);
}

function toIterator(iterable $items) : iterable
{
    foreach ($items as $key => $value) {
        yield $key => $value;
    }
}

function toPairs(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $key => $value) {
            yield [$key, $value];
        }
    });
}

function values(iterable $items) : iterable
{
    return _arrayOrIterator($items, function($items) {
        foreach ($items as $_ => $value) {
            yield $value;
        }
    });
}

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