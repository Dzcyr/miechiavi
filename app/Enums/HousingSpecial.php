<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingSpecial extends Enum
{
    const MATURE_COMMUNITY = 1;
    const GYM_NEAR = 2;
    const HAVE_ELEVATOR = 3;
    const FIRST_RENT = 4;
    const CAN_MONTH_RENT = 5;
    const AFFORESTATION_RATE_HIGH = 6;
    const INTELLIGENT_AIR = 7;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::MATURE_COMMUNITY:
				return '成熟小区';
				break;
			case self::GYM_NEAR:
				return '健身房附近';
                break;
            case self::HAVE_ELEVATOR:
				return '有电梯';
                break;
            case self::FIRST_RENT:
				return '首次出租';
                break;
            case self::CAN_MONTH_RENT:
				return '可月租';
                break;
            case self::AFFORESTATION_RATE_HIGH:
				return '绿化率高';
                break;
            case self::INTELLIGENT_AIR:
				return '智能新风';
				break;
		}
	    return parent::getDescription($value);
	}
}
