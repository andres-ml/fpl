<?php

namespace Aml\Fpl\functions;

function _arrayOrIterator($base, $generator)
{
    $result = $generator($base);
    return is_array($base) ? iterator_to_array($result) : $result;
}

function toArray($items)
{
    return is_array($items) ? $items : iterator_to_array($items);
}

function map($function, $items)
{
    return _arrayOrIterator($items, function($items) use($function) {
        foreach ($items as $key => $value) {
            yield $key => $function($value, $key);
        }
    });
}

function takeWhile($function, $items)
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

function dropWhile($function, $items)
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