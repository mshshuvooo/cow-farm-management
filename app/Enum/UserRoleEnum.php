<?php
namespace App\Enum;


enum UserRoleEnum:string
{
    case ADMIN = 'admin';
    case SUBSCRIBER = 'subscriber';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

