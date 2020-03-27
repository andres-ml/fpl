<?php

namespace Aml\Fpl\functions;

function complement($function) : callable
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
        return reduce($reducer, $args, array_reverse($functions))[0];
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

function flip($function) : callable
{
    return function($a, $b, ...$args) use($function) {
        return call_user_func($function, $b, $a, ...$args);
    };
}

function nAry(int $arity, callable $function) : callable
{
    return function(...$args) use($arity, $function) {
        return call_user_func_array($function, slice(0, $arity, $args));
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

function useWith(array $argCallbacks, $function) : callable
{
    return function(...$args) use($argCallbacks, $function) {
        $modifyArgument = function($arg, $index) use($argCallbacks) {
            return call_user_func($argCallbacks[$index], $arg);
        };
        return call_user_func_array($function, map($modifyArgument, $args));
    };
}