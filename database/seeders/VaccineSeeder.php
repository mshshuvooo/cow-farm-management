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
        Vaccine::factory()->count(20000)->create();

        $vaccines = Vaccine::all();

        Cow::all()->each(function ($cow) use($vaccines) {
            if(rand(0, 10) > 5) {
                $cow->vaccines()->attach(
                    $vaccines->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        });
        // Vaccine::create([
        //     "vaccination_date" => "2023/11/23",
        //     "vaccine_type" => "fmd",
        //     "cows" => array(1, 2)
        // ]);

        // Vaccine::create([
        //     "vaccination_date" => "2024/01/05",
        //     "vaccine_type" => "hs",
        //     "cows" => array(1, 3)
        // ]);

        // Vaccine::create([
        //     "vaccination_date" => "2024/01/15",
        //     "vaccine_type" => "bq",
        //     "cows" => array(2)
        // ]);
    }
}
