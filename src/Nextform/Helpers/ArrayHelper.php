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
					if (is_null($lastResult)) {
						$result['[]'][$key] = $value;
					}
					else {
						$result[$key] = $value;
					}
				}
				else {
					$newKey = '[' . $key . ']';

					if (is_null($lastResult)) {
						$result[$newKey] = $value;
					}
					else {
						$lastResult[$lastKey . $newKey] = $value;
					}
				}
			}
		}

		return $result;
	}

	/**
	 * @param string
	 * @return string
	 */
	public static function getSerializedArrayEntry($str) {
		$parts = explode('[', $str);
		return $parts[0];
	}

	/**
	 * @param string
	 * @return boolean
	 */
	public static function isSerializedArray($str) {
		return !!preg_match('/^.*\[.*\]$/', $str);
	}
}