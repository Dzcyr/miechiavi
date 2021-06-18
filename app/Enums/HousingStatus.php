<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingStatus extends Enum
{
	const DEFAULT = 1;
	const SELECT = 2;
	const RECOMMEND = 3;

	public static function getDescription($value): string
	{
		switch ($value) {
			case self::DEFAULT:
				return '新上';
				break;
			case self::SELECT:
				return '精选';
				break;
			case self::RECOMMEND:
				return '推荐';
				break;
		}
		return parent::getDescription($value);
	}
}
