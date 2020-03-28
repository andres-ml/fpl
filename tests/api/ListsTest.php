<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class ListsTest extends TestCase
{

    /**
     * @return void
     */
    public function testAll() : void
    {
        $this->assertEquals(true, all(identity, [true, 1, 'a']));
        $this->assertEquals(false, all(identity, [false, 1, 'a']));
        $this->assertEquals(false, all(identity, [true, 0, 'a']));
        $this->assertEquals(false, all(identity, [true, 1, '']));

        $notNull = function($value) {
            return $value !== null;
        };
        $this->assertEquals(true, all($notNull, [false, 0, '']));
    }

    /**
     * @return void
     */
    public function testAny() : void
    {
        $expected = 5;
        $isExpected = function($x) use($expected) {
            return $x === $expected;
        };
        $this->assertEquals(true, any($isExpected, [3, 4, 5]));
        $this->assertEquals(true, any($isExpected, counter()));
    }

    /**
     * @return void
     */
    public function testChunk() : void
    {
        $this->assertEquals([[0, 1, 2], [3, 4, 5], [6, 7]], toArray(chunk(3, counter(0, 8))));
        $this->assertEquals([['a', 'b', 'c']], chunk(3, ['a' => 'a', 'b' => 'b', 'c' => 'c']));
    }

    /**
     * @return void
     */
    public function testDropWhile() : void
    {
        $this->assertEquals([0, 1, 2, 3], values(dropWhile(identity, [3, 2, 1, 0, 1, 2, 3])));

        $lowerThan5 = function($x) {
            return $x < 5;
        };
        $this->assertEquals(5, head(dropWhile($lowerThan5, counter())));
    }

    /**
     * @return void
     */
    public function testEach() : void
    {
        $number = 4;
        $addToNumber = function($z) use(&$number) {
            $number += $z;
        };

        $this->assertEquals([1, 2, 3], each($addToNumber, [1, 2, 3]));
        $this->assertEquals(10, $number);
    }

    /**
     * @return void
     */
    public function testFlatten() : void
    {
        $this->assertEquals([1, 2, [3, 4]], flatten(1, [1, [2, [3, 4]]]));
        $this->assertEquals([1, 2, 3, 4], flatten(INF, [1, [2, [3, 4]]]));
        $this->assertEquals([0, 0, 1, 1], compose(
            toArray,
            flatten(1),
            slice(0, 2),
            zip,
        )(counter(), counter()));
    }

    /**
     * @return void
     */
    public function testFilter() : void
    {
        $is2 = function($value, $key) {
            return $value === 2 || $key === 2;
        };
        $this->assertEquals([2 => 3, 3 => 2], filter($is2, [
            0 => 1,
            1 => 0,
            2 => 3,
            3 => 2,
        ]));
    }

    /**
     * @return void
     */
    public function testFromPairs() : void
    {
        $this->assertEquals(['a' => 1, 'b' => 2], fromPairs([
            ['a', 1],
            ['b', 2],
        ]));
    }

    /**
     * @return void
     */
    public function testGroupBy() : void
    {
        $grouped = groupBy(index('age'), [
             ['name' => 'Pete', 'age' => 30],
             ['name' => 'Carl', 'age' => 25],
             ['name' => 'Martha', 'age' => 30],
        ]);
        $expected = [
            30 => [
                ['name' => 'Pete', 'age' => 30],
                ['name' => 'Martha', 'age' => 30],
            ],
            25 => [
                ['name' => 'Carl', 'age' => 25],
            ],
        ];
        $this->assertEquals($expected, $grouped);
    }

    /**
     * @return void
     */
    public function testHead() : void
    {
        $this->assertEquals(1, head([1, 2]));
        $this->assertEquals(1, head(counter(1)));
    }

    /**
     * @return void
     */
    public function testKeys() : void
    {
        $this->assertEquals(['a', 'b'], keys(['a' => 1, 'b' => 2]));
        $this->assertEquals(0, head(keys([1, 2])));
        $this->assertEquals(0, head(keys(counter(3))));
    }

    /**
     * @return void
     */
    public function testLast() : void
    {
        $this->assertEquals(2, last([1, 2]));
        $this->assertEquals(2, last(counter(1, 3)));
    }

    /**
     * @return void
     */
    public function testMap() : void
    {
        $this->assertEquals([1, 3], map(head, [[1, 2], [3, 4]]));
        $multiplyBy2 = function($x) {
            return $x * 2;
        };
        $this->assertEquals([2, 4, 6], toArray(map($multiplyBy2, counter(1, 4))));
    }

    /**
     * @return void
     */
    public function testPick() : void
    {
        $this->assertEquals(['b' => 2], pick(['b'], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    /**
     * @return void
     */
    public function testPickBy() : void
    {
        $this->assertEquals(
            ['b' => 2],
            pickBy(function($value) {
                return $value === 2;
            }, ['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

    /**
     * @return void
     */
    public function testOmit() : void
    {
        $this->assertEquals(['a' => 1, 'c' => 3], omit(['b'], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    /**
     * @return void
     */
    public function testOmitBy() : void
    {
        $this->assertEquals(
            ['a' => 1, 'c' => 3],
            omitBy(function($value) {
                return $value === 2;
            }, ['a' => 1, 'b' => 2, 'c' => 3])
        );
    }

    /**
     * @return void
     */
    public function testReduce() : void
    {
        $sum = pack('array_sum');
        $this->assertEquals(6, reduce($sum, 0, [1, 2, 3]));
        $this->assertEquals(7, reduce($sum, 1, [1, 2, 3]));
    }

    /**
     * @return void
     */
    public function testSearch() : void
    {
        $expected = 5;
        $isExpected = function($x) use($expected) {
            return $x === $expected;
        };
        $this->assertEquals($expected, search($isExpected, counter()));
    }

    /**
     * @return void
     */
    public function testSort() : void
    {
        $comparator = function($a, $b) {
            return $a <=> $b;
        };
        $this->assertEquals([1, 2, 3], sort($comparator, [2, 1, 3]));
        $this->assertEquals([1, 2, 3], sort($comparator, counter(1, 4)));
    }

    /**
     * @return void
     */
    public function testSortBy() : void
    {
        $this->assertEquals([1, 2, 3], sortBy(identity, [2, 1, 3]));
        $reversed = function($x) {
            return -$x;
        };
        $this->assertEquals([3, 2, 1], sortBy($reversed, [2, 1, 3]));
    }

    /**
     * @return void
     */
    public function testSlice() : void
    {
        $this->assertEquals([1 => 1, 2 => 2, 3 => 3], slice(1, 3, range(0, 5)));
        $this->assertEquals([1 => 1, 2 => 2, 3 => 3], toArray(slice(1, 3, counter())));
    }

    /**
     * @return void
     */
    public function testTakeWhile() : void
    {
        $this->assertEquals([3, 2, 1], takeWhile(identity, [3, 2, 1, 0, 1, 2, 3]));

        $lowerThan5 = function($x) {
            return $x < 5;
        };
        $this->assertEquals(4, last(takeWhile($lowerThan5, counter())));
    }

    /**
     * @return void
     */
    public function testToArray() : void
    {
        $this->assertEquals([1, 2], toArray([1, 2]));
        $this->assertEquals([1, 2], toArray(counter(1, 3)));
    }

    /**
     * @return void
     */
    public function testToIterator() : void
    {
        $iterator = toIterator([1, 2]);
        $this->assertIsNotArray($iterator);
        $this->assertEquals([1, 2], toArray($iterator));
    }

    /**
     * @return void
     */
    public function toPairs() : void
    {
        $this->assertEquals([['a', 1], ['b', 2]], toPairs(['a' => 1, 'b' => 2]));
    }

    /**
     * @return void
     */
    public function testValues() : void
    {
        $this->assertEquals([1, 2], values(['a' => 1, 'b' => 2]));
    }

    /**
     * @return void
     */
    public function testZip() : void
    {
        $this->assertEquals([[1, 3], [2, 4]], zip([1, 2], [3, 4]));
        $this->assertEquals([1, 2, 3], head(zip(counter(1), counter(2), counter(3))));
    }

}