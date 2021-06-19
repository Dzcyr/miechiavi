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
        switch ($value) {
            case self::REFRIGERATOR:
                $url = '1.jpg';
                break;
            case self::PRIVATE_BATHROOM:
                $url = '2.jpg';
                break;
            case self::ELEVATOR:
                $url = '3.jpg';
                break;
            case self::AIR_CONDITIONER:
                $url = '4.jpg';
                break;
            case self::HEATING:
                $url = '5.jpg';
                break;
            case self::CLOSET:
                $url = '6.jpg';
                break;
            case self::BALCONY:
                $url = '7.jpg';
                break;
            case self::HOT_WATER:
                $url = '8.jpg';
                break;
            case self::WIFI:
                $url = '9.jpg';
                break;
            case self::WASHING_MACHINE:
                $url = '10.jpg';
                break;
        }
        return ($url) ?? '';
    }
}
