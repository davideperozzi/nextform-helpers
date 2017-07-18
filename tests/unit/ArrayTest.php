<?php

namespace Nextform\Helpers\Tests;

use PHPUnit\Framework\TestCase;
use Nextform\Helpers\ArrayHelper;

class ArrayTest extends TestCase
{
	/**
	 *
	 */
	public function testArrayKeySerialization() {
		$serializedArray = ArrayHelper::serializeArrayKeys([
			'test' => [
				'test2' => [
					'val1', 'val2'
				]
			]
		]);

		$this->assertEquals(key($serializedArray), '[test][test2][]');
	}

	/**
	 *
	 */
	public function testSerializedArray() {
		$this->assertTrue(ArrayHelper::isSerializedArray('hello[]'));
		$this->assertTrue(ArrayHelper::isSerializedArray('hello[test][]'));
		$this->assertFalse(ArrayHelper::isSerializedArray('hello'));
		$this->assertFalse(ArrayHelper::isSerializedArray('[]hello'));
	}
}