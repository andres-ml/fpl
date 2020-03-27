<?php

namespace Aml\Fpl\functions;


function complement($function)
{
    return function(...$args) use($function) {
        return !call_user_func_array($function, $args);
    };
}

function compose(...$functions) : callable
{
    return function(...$args) use($functions) {
        $reducer = function($arguments, $function) {
            return [call_user_func_array($function, $arguments)];
        };
        return array_reduce(array_reverse($functions), $reducer, $args)[0];
    };
}

function curry($function) : callable
{
    $fixedArguments = array_filter((new \ReflectionFunction($function))->getParameters(), function($parameter) {
        return !$parameter->isOptional() && !$parameter->isVariadic();
    });
    return curryN(\count($fixedArguments), $function);
}

function curryN(int $N, $function) : callable
{
    return function(...$args) use($N, $function) {
        if (\count($args) < $N) {
            return curryN($N - \count($args), partial($function, ...$args));
        }
        return $function(...$args);
    };
}

function partial($function, ...$partialArgs) : callable
{
    return function(...$args) use($function, $partialArgs) {
        return call_user_func_array($function, array_merge($partialArgs, $args));
    };
}

function pipe(...$functions) : callable
{
    return compose(...array_reverse($functions));
}