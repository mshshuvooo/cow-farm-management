<?php
namespace App\Enum;


enum VaccineTypeEnum:string
{
    case FMD = 'fmd';
    case ANTHRAX = 'anthrax';
    case BQ = 'bq';
    case HS = 'hs';
    case DEWORMER_TAB = 'dewormer_tab';
    case DEWORMER_INJ = 'dewormer_inj';
    case LUMPY = 'lumpy';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

