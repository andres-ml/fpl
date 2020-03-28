<?php

namespace Aml\Fpl\functions;

/**
 * Instantiates/constructs an instance of `$class` with the specified arguments.
 *
 * @param string $class
 * @param mixed[] ...$args
 * @return mixed an instance of $class
 */
function construct($class, ...$args)
{
    return new $class(...$args);
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
function identity($item)
{
    return $item;
}

/**
 * Accesses `$array` at its position `$index`.
 *
 * @param mixed $index
 * @param array|\ArrayAccess $array
 * @return mixed
 */
function index($index, $array)
{
    return $array[$index];
}

/**
 * Accesses `$array` at its position `$index`, but returns `$else` when the index is not set or is null.
 *
 * @param mixed $index
 * @param mixed $else
 * @param array|\ArrayAccess $array
 * @return void
 */
function indexOr($index, $else, $array)
{
    return $array[$index] ?? $else;
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
function invoker(string $method, ...$args) : callable
{
    return function($object) use($method, $args) {
        return call_user_func_array([$object, $method], $args);
    };
}

/**
 * Attempts to get property `$property` from object `$object`.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function prop(string $property, $object)
{
    return $object->{$property};
}

/**
 * Attempts to get property `$property` from object `$object`, but returns `$else` when the property is not set or is null.
 *
 * @param string $property
 * @param object $object
 * @return mixed
 */
function propOr(string $property, $else, $object)
{
    return $object->{$property} ?? $else;
}

/**
 * Applies the spaceship operator on its two arguments
 *
 * @param mixed $a
 * @param mixed $b
 * @return integer
 */
function spaceship($a, $b) : int
{
    return $a <=> $b;
}