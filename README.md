# Functional PHP Library

This library provides a series of curried, data-last functions commonly used within the functional programming paradigm.

```php
use const Aml\Fpl{partial, map};

$multiplyItemsBy2 = partial(map, function($x) { return $x * 2; });
$multiplyItemsBy2([1, 2, 3]); // [2, 4, 6]
```

List-related functions return an array when they receive an array parameter, but they return iterators when receiving iterators (and can thus behave lazily). You can force laziness over an initial array by previously using `toIterator` or finish off with an array by ending with `toArray`:
```php
use const Aml\Fpl{takeWhile, counter};

$lowerThan4 = function($x) { return $x < 4; };

takeWhile($lowerThan4, [0, 1, 2, 3, 4, 5]); // [0, 1, 2, 3]

$pickLowerThan4 = compose(toArray, takeWhile($lowerThan4), counter);
$pickLowerThan4(); // [0, 1, 2, 3]
```

If you want, you can use the original function definitions instead. Note that these are not curried and cannot be used as parameters (like `map` in the example above), but do play well with code hinting.

```php
use function Aml\Fpl\functions{map};
use const Aml\Fpl\{partial};

partial();  // hinted as ' Aml\Fpl\partial'
map(...);   // hinted as function map($callable, $items)
```
#

Todo:
* Code generation
* Test framework
* Doc generation

Missing functions
* keys, values
* flip
* toArray, toList
* reduce
* prop, propOr
* index, indexOr
* invoker
* slice
* head, last, tail, init
* chunk
* groupBy
* zip
* flatten
* fromPairs
* toPairs
* any
* all
* search
* filter
* each