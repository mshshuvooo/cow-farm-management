<?php
namespace App\Enum;


enum VaccineTypeEnum:string
{
    case FMD = 'fmd';
    case ANTHRAX = 'anthrax';
    case BQ = 'bq';
    case HS = 'hs';
    case DEWORMER = 'dewormer';
    case LUMPY = 'lumpy';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

