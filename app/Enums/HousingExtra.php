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
        $storage = \Storage::disk(env('FILESYSTEM_DRIVER'));
        $path = 'others/icons/';
        switch ($value) {
            case self::REFRIGERATOR:
                $url = $storage->url($path . '1.png');
                break;
            case self::PRIVATE_BATHROOM:
                $url = $storage->url($path . '2.png');
                break;
            case self::ELEVATOR:
                $url = $storage->url($path . '3.png');
                break;
            case self::AIR_CONDITIONER:
                $url = $storage->url($path . '4.png');
                break;
            case self::HEATING:
                $url = $storage->url($path . '5.png');
                break;
            case self::CLOSET:
                $url = $storage->url($path . '6.png');
                break;
            case self::BALCONY:
                $url = $storage->url($path . '7.png');
                break;
            case self::HOT_WATER:
                $url = $storage->url($path . '8.png');
                break;
            case self::WIFI:
                $url = $storage->url($path . '9.png');
                break;
            case self::WASHING_MACHINE:
                $url = $storage->url($path . '10.png');
                break;
        }
        return ($url) ?? '';
    }
}
