<?php
namespace App\Enum;


enum InseminationTypeEnum:string
{
    case ARTIFICIAL = 'artificial';
    case NATURAL = 'natural';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

