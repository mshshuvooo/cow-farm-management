<?php
namespace App\Enum;


enum BullBreedEnum:string
{
    case HF = 'hf';
    case HF50 = 'hf50';
    case HF75 = 'hf75';
    case HF100 = 'hf100';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

