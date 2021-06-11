<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingHeating extends Enum
{
    const COLLECTIVE = 1;
    const INDEPENDENT = 2;
    const CENTRAL = 3;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::COLLECTIVE:
				return '集体供暖';
				break;
			
			case self::INDEPENDENT:
				return '独立供暖';
                break;
            case self::CENTRAL:
				return '中央供暖';
                break;
		}
	    return parent::getDescription($value);
	}
}
