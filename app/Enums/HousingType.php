<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingType extends Enum
{
    const ENTIRE_RENT = 1;
    const GATHERS_RENT = 2;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::ENTIRE_RENT:
				return '整租';
				break;
			
			case self::GATHERS_RENT:
				return '合租';
				break;
		}
	    return parent::getDescription($value);
	}
}
