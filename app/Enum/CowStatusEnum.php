<?php
namespace App\Enum;


enum CowStatusEnum:string
{
    case ACTIVE = 'active';
    case SOLD = 'sold';
    case DEAD = 'dead';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

