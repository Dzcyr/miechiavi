<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class HousingExtra extends Enum
{
    const REFRIGERATOR = 1;
    const PRIVATE_BATHROOM = 2;
    const ELEVATOR = 3;
    const AIR_CONDITIONER = 4;
    const HEATING = 5;
    const CLOSET = 6;
    const BALCONY = 7;
    const HOT_WATER = 8;
    const WIFI = 9;
    const WASHING_MACHINE = 10;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::REFRIGERATOR:
                return '冰箱';
                break;
            case self::PRIVATE_BATHROOM:
                return '独卫';
                break;
            case self::ELEVATOR:
                return '电梯';
                break;
            case self::AIR_CONDITIONER:
                return '空调';
                break;
            case self::HEATING:
                return '暖气';
                break;
            case self::CLOSET:
                return '衣柜';
                break;
            case self::BALCONY:
                return '阳台';
                break;
            case self::HOT_WATER:
                return '热水';
                break;
            case self::WIFI:
                return 'WIFI';
                break;
            case self::WASHING_MACHINE:
                return '洗衣机';
                break;
        }
        return parent::getDescription($value);
    }

    public static function getIcon($value)
    {
        if(!empty($value)) {
            $storage = \Storage::disk(env('FILESYSTEM_DRIVER'));
            $path = 'others/icons/';
            $url = $storage->url($path . HousingExtra::getDescription($value) . '.png');
            // $url = $storage->url($path . '1_old.png');
        }
        return ($url) ?? '';
    }
}
