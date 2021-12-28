<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @psalm-suppress UndefinedMagicMethod
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'address1' => $this->faker->streetAddress(),
            'address2' => $this->faker->optional()->secondaryAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip' => Str::substr($this->faker->postcode(), 0, 5),
        ];
    }

    /**
     * Generate a soft deleted venue.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
