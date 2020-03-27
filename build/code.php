<?php

/* This file was automatically generated */
namespace Aml\Fpl;

const complement = 'Aml\\Fpl\\complement';
const compose = 'Aml\\Fpl\\compose';
const counter = 'Aml\\Fpl\\counter';
const curry = 'Aml\\Fpl\\curry';
const curryN = 'Aml\\Fpl\\curryN';
const dropWhile = 'Aml\\Fpl\\dropWhile';
const identity = 'Aml\\Fpl\\identity';
const map = 'Aml\\Fpl\\map';
const partial = 'Aml\\Fpl\\partial';
const pipe = 'Aml\\Fpl\\pipe';
const takeWhile = 'Aml\\Fpl\\takeWhile';
const toArray = 'Aml\\Fpl\\toArray';
/* ----------------- */
function complement(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\complement')(...$args);
}
function compose(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\compose')(...$args);
}
function counter(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\counter')(...$args);
}
function curry(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\curry')(...$args);
}
function curryN(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\curryN')(...$args);
}
function dropWhile(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\dropWhile')(...$args);
}
function identity(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\identity')(...$args);
}
function map(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\map')(...$args);
}
function partial(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\partial')(...$args);
}
function pipe(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\pipe')(...$args);
}
function takeWhile(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\takeWhile')(...$args);
}
function toArray(...$args)
{
    return \Aml\Fpl\functions\curry('Aml\\Fpl\\functions\\toArray')(...$args);
}