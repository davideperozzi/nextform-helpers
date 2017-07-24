<?php

namespace Nextform\Helpers\Tests;

use Nextform\Helpers\ArrayHelper;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function testArrayKeySerializationFlat()
    {
        $serializedArray = ArrayHelper::serializeArrayKeys([
            'test' => [
                'v1', 'v2', 'v2'
            ]
        ]);

        $this->assertEquals(key($serializedArray), '[test][]');
        $this->assertEquals(count($serializedArray['[test][]']), 3);
    }


    public function testArrayKeySerializationDeep()
    {
        $serializedArray = ArrayHelper::serializeArrayKeys([
            'test' => [
                'test2' => [
                    'val1', 'val2'
                ]
            ]
        ]);

        $this->assertEquals(key($serializedArray), '[test][test2][]');
        $this->assertEquals(count($serializedArray['[test][test2][]']), 2);
    }


    public function testSerializedArray()
    {
        $this->assertTrue(ArrayHelper::isSerializedArray('hello[]'));
        $this->assertTrue(ArrayHelper::isSerializedArray('hello[test][]'));
        $this->assertFalse(ArrayHelper::isSerializedArray('hello'));
        $this->assertFalse(ArrayHelper::isSerializedArray('[]hello'));
    }


    public function testSerializedArrayEntry()
    {
        $this->assertEquals(ArrayHelper::getSerializedArrayEntry('hello[]'), 'hello');
        $this->assertEquals(ArrayHelper::getSerializedArrayEntry('hello2[test][]'), 'hello2');
    }
}
