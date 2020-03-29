<?php

namespace Aml\Fpl\functions;

/**
 * Generates integers from `$from` (included) to `$to` (excluded) with a step of `$step`.
 * Similar to range() but as a generator.
 * 
 * ```
 * counter();   // 0, 1, 2....
 * counter(1, 10, 3);  // 1, 4, 7
 * ```
 *
 * @param integer $from
 * @param integer $to
 * @param integer $step
 * @return iterable
 */
function counter(int $from = 0, $to = INF, int $step = 1) : iterable
{
    for ($i = $from; $i < $to; $i += $step) {
        yield $i;
    }
}