<?php

namespace Aml\Fpl\functions;

function counter($from = 0, $to = null, $step = 1)
{
    for ($i = $from; $to === null || $i < $to; $i += $step) {
        yield $i;
    }
}