<?php

namespace Database\Factories;

use App\Models\Cow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cow>
 */
class CowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        try {
            return [
                "ear_tag_no" => $this->faker->unique()->randomNumber(),
                "name" => substr($this->faker->unique()->name(), 0, 24),
                // "gender" => $this->faker->randomElements(["male","female"]),
                // "status" => $this->faker->randomElements(["active","sold","dead"]),
                "date_of_birth" => $this->faker->date(),
                // "mother_id" => Cow::where('gender','female')->count() > 0 && $this->faker->randomDigit() > 4 ? $this->faker->randomElements(Cow::where('gender','female')->pluck('id')) : null,
            ];
        }catch(\Exception $e){
            //do nothing
        }

    }
}
