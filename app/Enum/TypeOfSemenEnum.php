<?php
namespace App\Enum;


enum TypeOfSemenEnum:string
{
    case FROZEN = 'frozen';
    case LIQUID = 'liquid';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

