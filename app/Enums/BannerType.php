<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BannerType extends Enum
{
    const TYPE_DEFAULT = 1;
    const TYPE_NOTICE = 2;
    const TYPE_CONSULT = 3;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::TYPE_DEFAULT:
				return '默认';
				break;
			
			case self::TYPE_NOTICE:
				return '通知';
				break;

			case self::TYPE_CONSULT:
				return '咨询';
				break;
		}
	    return parent::getDescription($value);
	}
}
