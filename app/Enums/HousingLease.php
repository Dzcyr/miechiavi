<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingLease extends Enum
{
	const OFF = 1;
	const ON = 2;

	public static function getDescription($value): string
	{
		switch ($value) {
			case self::OFF:
				return '未出租';
				break;
			case self::ON:
				return '已出租';
				break;
		}
		return parent::getDescription($value);
	}
}
