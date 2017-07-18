<?php

namespace Nextform\Helpers;

class ArrayHelper
{
	/**
	 * Pseudo array serialization
	 *
	 * @param array $arr
	 * @param array &$lastResult
	 * @param string $lastKey
	 * @return array
	 */
	public static function serializeArrayKeys($arr, &$lastResult = null, $lastKey = '') {
		$result = [];

		foreach ($arr as $key => $value) {
			if (is_array($value)) {
				$newKey = '[' . $key . ']';
				$newResult = &$result;

				if ( ! is_null($lastResult)) {
					$newResult = &$lastResult;
				}

				$reduced = static::serializeArrayKeys($value, $newResult, $lastKey . $newKey);

				if ( ! empty($reduced)) {
					$newResult[$lastKey . $newKey . '[]'] = $reduced;
				}
			}
			else {
				if (is_integer($key)) {
					$result[$key] = $value;
				}
				else {
					if ( ! is_null($lastResult)) {
						$newKey = '[' . $key . ']';

						$lastResult[$lastKey . $newKey] = $value;
					}
				}
			}
		}

		return $result;
	}

	/**
	 * @param string
	 * @return boolean
	 */
	public static function isSerializedArray($str) {
		return !!preg_match('/^.*\[.*\]$/', $str);
	}
}