<?php

namespace Database\Seeders;

use App\Enum\CowGenderEnum;
use App\Enum\CowStatusEnum;
use App\Models\Cow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cow::create([
            "name" => "Cow1",
            "ear_tag_no" => "1",
            "gender" => CowGenderEnum::FEMALE->value,
            "status" => CowStatusEnum::ACTIVE->value,
        ]);

        Cow::create([
            "name" => "Cow2",
            "ear_tag_no" => "2",
            "gender" => CowGenderEnum::MALE->value,
            "status" => CowStatusEnum::ACTIVE->value,
        ]);

        Cow::create([
            "name" => "Cow3",
            "ear_tag_no" => "3",
            "gender" => CowGenderEnum::MALE->value,
            "status" => CowStatusEnum::SOLD->value,
            "mother_id" => "1",
        ]);

        Cow::create([
            "name" => "Cow4",
            "ear_tag_no" => "4",
            "gender" => CowGenderEnum::FEMALE->value,
            "status" => CowStatusEnum::DEAD->value,
        ]);
    }
}
