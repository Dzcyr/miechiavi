<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ArticleType extends Enum
{
	const FAQ = 1;
	const OTHER = 2;

	public static function getDescription($value): string
	{
		switch ($value) {
			case self::FAQ:
				return 'FAQ';
				break;

			case self::OTHER:
				return '其它';
				break;
		}
		return parent::getDescription($value);
	}
}
