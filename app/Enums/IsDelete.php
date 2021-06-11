<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class IsDelete extends Enum
{
    const NOT_YET = 0;
   	const YES = 1;

    public static function getDescription($value): string
	{
		switch ($value) {
			case self::NOT_YET:
				return '正常';
				break;
			
			case self::YES:
				return '已删除';
				break;
		}
	    return parent::getDescription($value);
	}
}
