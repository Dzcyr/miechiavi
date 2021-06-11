<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingToward extends Enum
{
    const SOUTH = 1;
    const NORTH = 2;
    const EAST = 3;
    const WEST = 4;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::SOUTH:
				return '南';
				break;
			case self::NORTH:
				return '北';
                break;
            case self::EAST:
				return '东';
                break;
            case self::WEST:
				return '西';
                break;
		}
	    return parent::getDescription($value);
	}
}
