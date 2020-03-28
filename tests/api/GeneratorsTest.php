<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class GeneratorsTest extends TestCase
{

    /**
     * @return void
     */
    public function testCounter() : void
    {
        $takeFirst3 = compose(toArray, slice(0, 3));
        $this->assertEquals([0, 1, 2], $takeFirst3(counter(0, INF)));
        $this->assertEquals([0], $takeFirst3(counter(0, 1)));
        $this->assertEquals([0, 2, 4], $takeFirst3(counter(0, INF, 2)));
    }

}