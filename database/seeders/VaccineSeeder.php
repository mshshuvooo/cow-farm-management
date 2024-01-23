<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Database\Factories\CowVaccinationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cow;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaccine::factory()->count(20)->create();

        // $vaccines = Vaccine::all();

        // Cow::all()->each(function ($cow) use($vaccines) {
        //     if(rand(0, 10) > 5) {
        //         $cow->vaccines()->attach(
        //             $vaccines->random(rand(1, 3))->pluck('id')->toArray()
        //         );
        //     }
        // });

    }
}
