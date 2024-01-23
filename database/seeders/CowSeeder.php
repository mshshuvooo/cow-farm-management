<?php

namespace Database\Seeders;

use App\Enum\CowGenderEnum;
use App\Enum\CowStatusEnum;
use App\Models\Cow;
use Database\Factories\CowFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //CowFactory::new()->count(18)->create();
        Cow::create([
            "name" => "Shundori",
            "ear_tag_no" => "1",
            "gender" => CowGenderEnum::FEMALE->value,
            "status" => CowStatusEnum::ACTIVE->value,
        ]);

        Cow::create([
            "name" => "Shukkur Ali",
            "ear_tag_no" => "2",
            "gender" => CowGenderEnum::MALE->value,
            "status" => CowStatusEnum::ACTIVE->value,
        ]);

        Cow::create([
            "name" => "Roton",
            "ear_tag_no" => "3",
            "gender" => CowGenderEnum::MALE->value,
            "status" => CowStatusEnum::SOLD->value,
            "mother_id" => "1",
        ]);

        Cow::create([
            "name" => "Chandu",
            "ear_tag_no" => "4",
            "gender" => CowGenderEnum::MALE->value,
            "status" => CowStatusEnum::DEAD->value,
        ]);
    }
}
