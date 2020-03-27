<?php

namespace Aml\Fpl;

require_once __DIR__ . '/../vendor/autoload.php';

$add2andmore = function($x, $y, ...$args) {
    return array_sum(array_merge([$x, $y], $args));
};

$appendSomething = function($x, $suffix = 'foo') {
    return $x . $suffix;
};

$partial = partial($add2andmore, 1, 2);
var_dump(10 === $partial(3, 4));

$curried = curry($add2andmore);
var_dump(3 === $curried(1)(2));
var_dump(3 === $curried(1, 2));
var_dump(10 === $curried(1, 2, 3, 4));
var_dump(10 === $curried(1)(2, 3, 4));

$curriedN = curryN(5, $add2andmore);
var_dump(3 !== $curriedN(1, 2));
var_dump(10 !== $curriedN(1, 2, 3, 4));
var_dump(15 === $curriedN(1, 2, 3, 4, 5));
var_dump(15 === $curriedN(1)(2)(3)(4)(5));

$curried = curry($appendSomething);
var_dump('barfoo' === $curried('bar'));
var_dump('barbaz' === $curried('bar', 'baz'));

$curriedN = curryN(2, $appendSomething);
var_dump('barfoo' !== $curriedN('bar'));
var_dump('barbaz' === $curriedN('bar', 'baz'));

$mul2 = function($x) { return $x * 2; };
var_dump([2, 4, 6] === map($mul2)([1, 2, 3]));
var_dump([2, 4, 6] !== map($mul2, new \ArrayIterator([1, 2, 3])));
var_dump([2, 4, 6] === iterator_to_array(map($mul2, new \ArrayIterator([1, 2, 3]))));

$add3 = function($x) { return $x + 3; };
var_dump(28 === compose($mul2, $mul2)(7));
var_dump(20 === compose($mul2, $add3)(7));

$until3 = function($x) { return $x <= 3; };
var_dump([0, 1, 2, 3] === takeWhile($until3, [0, 1, 2, 3, 4]));
var_dump([4 => 4, 5 => 5] === dropWhile($until3, [0, 1, 2, 3, 4, 5]));

$pickFirst3 = compose(toArray, takeWhile($until3), counter);
var_dump([0, 1, 2, 3] === $pickFirst3());