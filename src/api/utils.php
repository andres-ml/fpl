<?php

namespace Aml\Fpl\functions;

function construct($class, ...$args)
{
    return new $class(...$args);
}

function identity($item)
{
    return $item;
}

function index($index, $array)
{
    return $array[$index];
}

function indexOr($index, $else, $array)
{
    return $array[$index] ?? $else;
}

function invoker(string $method, ...$args) : callable
{
    return function($object) use($method, $args) {
        return call_user_func_array([$object, $method], $args);
    };
}

function prop(string $property, $object)
{
    return $object->{$property};
}

function propOr(string $property, $else, $object)
{
    return $object->{$property} ?? $else;
}

function spaceship($a, $b) : int
{
    return $a <=> $b;
}