<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class ListsTest extends TestCase
{

    /**
     * 
     */
    public function testAny() : void
    {
        $expected = 5;
        $isExpected = function($x) use($expected) {
            return $x === $expected;
        };
        $this->assertEquals(true, any($isExpected, counter()));
    }

    /**
     * 
     */
    public function testChunk() : void
    {
        $this->assertEquals([[0, 1, 2], [3, 4, 5], [6, 7]], toArray(chunk(3, counter(0, 8))));
        $this->assertEquals([['a', 'b', 'c']], chunk(3, ['a' => 'a', 'b' => 'b', 'c' => 'c']));
    }

    /**
     * 
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
     * 
     */
    public function testPick() : void
    {
        $this->assertEquals(['b' => 2], pick(['b'], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    /**
     * 
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
     * 
     */
    public function testOmit() : void
    {
        $this->assertEquals(['a' => 1, 'c' => 3], omit(['b'], ['a' => 1, 'b' => 2, 'c' => 3]));
    }

    /**
     * 
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
     * 
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
     * 
     */
    public function testZip() : void
    {
        $this->assertEquals([[1, 3], [2, 4]], zip([1, 2], [3, 4]));
        $this->assertEquals([1, 2, 3], head(zip(counter(1), counter(2), counter(3))));
    }

}