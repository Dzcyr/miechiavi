<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingCost extends Enum
{
	const OFF = 1;
	const ON = 2;

	public static function getDescription($value): string
	{
		switch ($value) {
			case self::OFF:
				return '无中介费';
				break;
			case self::ON:
				return '有中介费';
				break;
		}
		return parent::getDescription($value);
	}
}
