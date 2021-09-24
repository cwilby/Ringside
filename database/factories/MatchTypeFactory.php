<?php

namespace Database\Factories;

use App\Models\MatchType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MatchTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $matchType = $this->faker->word();

        return [
            'name' => $matchType,
            'slug' => Str::slug($matchType),
        ];
    }
}
