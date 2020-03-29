<?php

namespace Aml\Fpl\functions;

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
function gt($cmp, $value) : bool
{
    return $value > $cmp;
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
function gte($cmp, $value) : bool
{
    return $value >= $cmp;
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
function lt($cmp, $value) : bool
{
    return $value < $cmp;
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
function lte($cmp, $value) : bool
{
    return $value <= $cmp;
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
function eq($cmp, $value) : bool
{
    return $value === $cmp;
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
function not($cmp) : bool
{
    return !$cmp;
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
function spaceship($a, $b) : int
{
    return $a <=> $b;
}