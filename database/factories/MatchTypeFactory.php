<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MatchTypeFactory extends Factory
{
    const DEFAULT_NUMBER_OF_SIDES_FOR_MATCH = 2;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /** @var string */
        $name = $this->faker->words(2, true);

        return [
            'name' => Str::of($name)->title(),
            'slug' => Str::slug($name),
            'number_of_sides' => self::DEFAULT_NUMBER_OF_SIDES_FOR_MATCH,
        ];
    }
}
