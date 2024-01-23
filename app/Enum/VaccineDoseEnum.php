<?php
namespace App\Enum;


enum VaccineDoseEnum:string
{
    case FIRST = 'first';
    case BOOSTER = 'booster';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

