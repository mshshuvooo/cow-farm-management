<?php
namespace App\Enum;


enum BullOwnerEnum:string
{
    case GOVT = 'govt';
    case ADL = 'adl';
    case BRAC = 'brac';
    case NIRAPOD = 'nirapod_agro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

