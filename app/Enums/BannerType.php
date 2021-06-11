<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BannerType extends Enum
{
    const DEFAULT = 1;
    const NOTICE = 2;
    const CONSULT = 3;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::DEFAULT:
				return '默认';
				break;
			
			case self::NOTICE:
				return '通知';
				break;

			case self::CONSULT:
				return '咨询';
				break;
		}
	    return parent::getDescription($value);
	}
}
