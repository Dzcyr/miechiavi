<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Image extends Enum
{
	const HOUSINGS_BEDROOM_IMAGES = 1;
	const HOUSINGS_PARLOUR_IMAGES = 2;
	const HOUSINGS_KITCHEN_IMAGES = 3;
	const HOUSINGS_TOILET_IMAGES = 4;
   
    public static function getDescription($value): string
	{
		switch ($value) {
			case self::HOUSINGS_BEDROOM_IMAGES:
				return 'housings/bedroom_images';
				break;
			case self::HOUSINGS_PARLOUR_IMAGES:
				return 'housings/parlour_images';
				break;
			case self::HOUSINGS_KITCHEN_IMAGES:
				return 'housings/kitchen_images';
				break;
			case self::HOUSINGS_TOILET_IMAGES:
				return 'housings/toilet_images';
				break;
		}
	    return parent::getDescription($value);
	}
}
