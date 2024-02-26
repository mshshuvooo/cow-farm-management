<?php

namespace Database\Seeders;

use App\Enum\BullBreedEnum;
use App\Enum\BullOwnerEnum;
use App\Models\BreedingBull;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreedingBullSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BreedingBull::create([
            "bull_name" => "ADL778",
            "bull_owner" => BullOwnerEnum::ADL->value,
            "bull_breed" => BullBreedEnum::HF100->value,
        ]);

        BreedingBull::create([
            "bull_name" => "BOSS10",
            "bull_owner" => BullOwnerEnum::NIRAPOD->value,
            "bull_breed" => BullBreedEnum::HF75->value,
        ]);
    }
}
