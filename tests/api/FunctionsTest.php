<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{

    /**
     * @return void
     */
    public function testComplement() : void
    {
        $isEven = function($x) {
            return $x % 2 === 0;
        };
        $isOdd = complement($isEven);
        $this->assertFalse($isOdd(2));
        $this->assertTrue($isOdd(3));
    }

    /**
     * @return void
     */
    public function testCompose() : void
    {
        $this->assertEquals(10, compose(
            function($x) { return $x * 2; },
            function($x) { return $x + 4; }
        )(1));
    }

    /**
     * @return void
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
     * @return void
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

    /**
     * @return void
     */
    public function testFlip() : void
    {
        $prepend = flip('array_merge');
        $this->assertEquals([2, 1, 3], $prepend([1], [2], [3]));
    }

    /**
     * @return void
     */
    public function testInvoker() : void
    {
        $a = new \ArrayObject(['a' => 1]);
        $b = new \ArrayObject(['b' => 2]);
        $hasA = invoker('offsetExists', 'a');
        $this->assertEquals([true, false], map($hasA, [$a, $b]));
    }

    /**
     * @return void
     */
    public function testNAry() : void
    {
        $sum = function($a, $b = 0) {
            return $a + $b;
        };
        $this->assertEquals(3, nAry(1, $sum)(3, 4));
    }

    /**
     * @return void
     */
    public function testPack() : void
    {
        $sum = pack('array_sum');
        $this->assertEquals(6, $sum(1, 2, 3));
    }

    /**
     * @return void
     */
    public function testPartial() : void
    {
        $prepend1 = partial('array_merge', [1]);
        $this->assertEquals([1, 2, 3], $prepend1([2, 3]));
    }

    /**
     * @return void
     */
    public function testPipe() : void
    {
        $this->assertEquals(6, pipe(
            function($x) { return $x * 2; },
            function($x) { return $x + 4; }
        )(1));
    }

    /**
     * @return void
     */
    public function testUnpack() : void
    {
        $words = compose(
            unpack('array_merge'),
            map(nAry(1, partial('explode', ' ')))
        );
        $this->assertEquals(['a', 'sentence', 'some', 'other', 'sentence'], $words(['a sentence', 'some other sentence']));
    }

    /**
     * @return void
     */
    public function testUseWith() : void
    {
        $multiplyBy = curry(function($x, $y) { return $x*$y; });
        $sum = function($a, $b) { return $a + $b; };

        $sumDuplicates = useWith([$multiplyBy(3), $multiplyBy(4)], $sum);
        $this->assertEquals(11, $sumDuplicates(1, 2));
    }

}