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
     */
    public function definition(): array
    {
        // $this->faker->addProvider(new \Faker\Provider\en_US\Address($this->faker));

        return [
            'name' => $this->faker->sentence(),
            'address1' => $this->faker->buildingNumber() . ' ' . $this->faker->streetName(),
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
