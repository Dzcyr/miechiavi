<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingWithdraw extends Enum
{
	const OFF = 1;
	const ON = 2;

	public static function getDescription($value): string
	{
		switch ($value) {
			case self::OFF:
				return '未下架';
				break;
			case self::ON:
				return '已下架';
				break;
		}
		return parent::getDescription($value);
	}
}
