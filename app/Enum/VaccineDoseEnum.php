<?php
namespace App\Enum;


enum VaccineDoseEnum:string
{
    case REGULAR = 'regular';
    case BOOSTER = 'booster';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

