<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{

    /**
     * 
     */
    public function testCurry() : void
    {
        $add2OrMore = function($a, $b, ...$rest) {
            return array_sum(array_merge([$a, $b], $rest));
        };

        $curried = curry($add2OrMore);
        $this->assertIsCallable($curried());
        $this->assertIsCallable($curried(1));
        $this->assertEquals(3, $curried(1, 2));
        $this->assertEquals(6, $curried(1, 2, 3));
    }

    /**
     * 
     */
    public function testCurryN() : void
    {
        $add2OrMore = function($a, $b, ...$rest) {
            return array_sum(array_merge([$a, $b], $rest));
        };

        $curried = curryN(3, $add2OrMore);
        $this->assertIsCallable($curried());
        $this->assertIsCallable($curried(1));
        $this->assertIsCallable($curried(1, 2));
        $this->assertEquals(6, $curried(1, 2, 3));
        $this->assertEquals(10, $curried(1, 2, 3, 4));
    }

}