<?php

namespace Aml\Fpl\functions;

function counter(int $from = 0, $to = INF, int $step = 1) : iterable
{
    for ($i = $from; $i < $to; $i += $step) {
        yield $i;
    }
}