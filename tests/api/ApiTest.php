<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

/**
 * Includes tests related to the api as a whole, not specific functions
 */
class ApiTest extends TestCase
{

    /**
     * Test that generated functions are automatically curried
     * 
     * @return void
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
        $this->assertEquals($expected, map(...)($multiplyBy2)($array));
    }

    /**
     * Test that calling a curried function with no arguments throws
     * 
     * @return void
     */
    public function testNoArgumentsCallThrows() : void
    {
        $this->expectException(\ArgumentCountError::class);
        map();
    }

}