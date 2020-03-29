<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class OperatorsTest extends TestCase
{

    /**
     * @return void
     */
    public function testBooleanOperators() : void
    {
        $statements = [
            gt(0, 1),
            !gt(0, 0),
            gt('a', 'b'),
            gte(0, 1),
            gte(0, 0),
            lt(1, 0),
            !lt(0, 0),
            lte(1, 0),
            lte(0, 0),
            not(''),
            not(0),
            not(false),
            !not(true),
            eq(3, 3),
            !eq(3, '3'),
        ];

        foreach ($statements as $index => $statement) {
            $this->assertTrue($statement, "Failed assertion on op $index");
        }
    }

    /**
     * @return void
     */
    public function testSpaceship() : void
    {
        $this->assertEquals(0, spaceship(1, 1));
        $this->assertEquals(1, spaceship(2, 1));
        $this->assertEquals(-1, spaceship(1, 2));
        $this->assertEquals(0, spaceship('a', 'a'));
        $this->assertEquals(1, spaceship('b', 'a'));
        $this->assertEquals(-1, spaceship('a', 'b'));
    }

}