<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{

    /**
     * Test that generated functions are automatically curried
     */
    public function testAutoCurrying() : void
    {
        $multiplyBy2 = function($x) {
            return $x * 2;
        };
        $array = [1, 2, 3];
        $expected = [2, 4, 6];
        $this->assertEquals($expected, map($multiplyBy2, $array));
        $this->assertEquals($expected, map($multiplyBy2)($array));
        $this->assertEquals($expected, map()($multiplyBy2)($array));
    }

    /**
     * Test that function consts are available
     */
    public function testConstAvailable() : void
    {
        $multiplyBy2 = function($x) { return $x * 2; };
        $this->assertEquals([2, 4, 6], partial(map, $multiplyBy2)([1, 2, 3]));
    }

}