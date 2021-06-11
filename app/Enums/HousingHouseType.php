<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingHouseType extends Enum
{
    const SINGLE_ROOM = 1;
    const ONE_BEDROOM = 2;
    const TWO_BEDROOM = 3;
    const THREE_BEDROOM = 4;
    const FOUR_BEDROOM = 5;
    const FIVE_BEDROOM = 6;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::SINGLE_ROOM:
				return '单间';
				break;
			
			case self::ONE_BEDROOM:
				return '一居室';
                break;
            case self::TWO_BEDROOM:
				return '两居室';
                break;
            case self::THREE_BEDROOM:
				return '三居室';
                break;
            case self::FOUR_BEDROOM:
				return '四居室';
                break;
            case self::FIVE_BEDROOM:
				return '五居室';
				break;
		}
	    return parent::getDescription($value);
	}
}
