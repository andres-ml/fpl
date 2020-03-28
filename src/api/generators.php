<?php

namespace Aml\Fpl\functions;

/**
 * Generates integers from `$from` to `$to` with a step of `$step`.
 * Similar to range() but as a generator.
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