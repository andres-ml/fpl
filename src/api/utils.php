<?php

namespace Aml\Fpl\functions;

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
function construct($class, ...$args)
{
    return new $class(...$args);
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
function identity($item)
{
    return $item;
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
function index($index, $array)
{
    return $array[$index];
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
function indexOr($index, $else, $array)
{
    return $array[$index] ?? $else;
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
function prop(string $property, $object)
{
    return $object->{$property};
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
function propOr(string $property, $else, $object)
{
    return $object->{$property} ?? $else;
}