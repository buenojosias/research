<?php

namespace App\Enums;

enum MonthEnum: int
{
    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    public function toString(): string
    {
        return match ($this) {
            self::JANUARY => 'janeiro',
            self::FEBRUARY => 'fevereiro',
            self::MARCH => 'março',
            self::APRIL => 'abril',
            self::MAY => 'maio',
            self::JUNE => 'junho',
            self::JULY => 'julho',
            self::AUGUST => 'agosto',
            self::SEPTEMBER => 'setembro',
            self::OCTOBER => 'outubro',
            self::NOVEMBER => 'novembro',
            self::DECEMBER => 'dezembro',
        };
    }

    public function toAbbr(): string
    {
        return match ($this) {
            self::JANUARY => 'jan.',
            self::FEBRUARY => 'fev.',
            self::MARCH => 'mar.',
            self::APRIL => 'abr.',
            self::MAY => 'maio',
            self::JUNE => 'jun.',
            self::JULY => 'jul.',
            self::AUGUST => 'ago.',
            self::SEPTEMBER => 'set.',
            self::OCTOBER => 'out.',
            self::NOVEMBER => 'nov.',
            self::DECEMBER => 'dez.',
        };
    }
}
