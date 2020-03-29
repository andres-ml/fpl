<?php

namespace Aml\Fpl;

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{

    /**
     * @return void
     */
    public function testConstruct() : void
    {
        $arrayObject = construct(\ArrayObject::class, [1, 2, 3]);
        $this->assertInstanceOf(\ArrayObject::class, $arrayObject);
        $this->assertEquals([1, 2, 3], $arrayObject->getArrayCopy());
    }

    /**
     * @return void
     */
    public function testIdentity() : void
    {
        $this->assertEquals(1, identity(1));
        $this->assertEquals('foo', identity('foo'));
    }

    /**
     * @return void
     */
    public function testIndex() : void
    {
        $this->assertEquals(1, index('a', ['a' => 1, 'b' => 2]));
        $this->assertEquals(1, index('a', new \ArrayObject(['a' => 1, 'b' => 2])));
    }

    /**
     * @return void
     */
    public function testIndexOr() : void
    {
        $this->assertEquals(1, indexOr('a', 3, ['a' => 1, 'b' => null]));
        $this->assertEquals(3, indexOr('b', 3, ['a' => 1, 'b' => null]));
        $this->assertEquals(3, indexOr('c', 3, ['a' => 1, 'b' => null]));
    }

    /**
     * @return void
     */
    public function testProp() : void
    {
        $object = new \stdClass();
        $object->a = 1;
        $object->b = null;
        $this->assertEquals(1, prop('a', $object));

        $magic = new ClassWithMagicProperty('a', 1);
        $this->assertEquals(1, prop('a', $magic));
    }

    /**
     * @return void
     */
    public function testPropOr() : void
    {
        $object = new \stdClass();
        $object->a = 1;
        $object->b = null;
        $this->assertEquals(1, propOr('a', 3, $object));
        $this->assertEquals(3, propOr('b', 3, $object));
        $this->assertEquals(3, propOr('c', 3, $object));
    }

}


class ClassWithMagicProperty
{

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function __get($name) {
        if ($name === $this->name) {
            return $this->value;
        }
    }
}