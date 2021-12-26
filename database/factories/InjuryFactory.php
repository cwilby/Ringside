<?php

namespace Database\Factories;

use App\Models\Injury;
use App\Models\Manager;
use App\Models\Referee;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InjuryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Injury::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $injurable = $this->injurable();

        return [
            'injurable_id' => $injurable::factory(),
            'injurable_type' => $injurable,
            'started_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Set the start date of the injury.
     *
     * @param  string|Carbon $injureDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function started($injureDate = 'now'): Factory
    {
        return $this->state([
            'started_at' => $injureDate instanceof Carbon ? $injureDate : new Carbon($injureDate),
        ]);
    }

    /**
     * Set the recovery date of the injury.
     *
     * @param  string|Carbon $recoveryDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ended($recoveryDate = 'now'): Factory
    {
        return $this->state([
            'ended_at' => $recoveryDate instanceof Carbon ? $recoveryDate : new Carbon($recoveryDate),
        ]);
    }

    /**
     * Retrieve a random injurable model.
     *
     * @return mixed
     */
    public function injurable(): mixed
    {
        return $this->faker->randomElement([
            Manager::class,
            Referee::class,
            Wrestler::class,
        ]);
    }
}
