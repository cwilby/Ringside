<?php

namespace Database\Factories;

use App\Models\Activation;
use App\Models\Stable;
use App\Models\Title;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Activation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $activatable = $this->activatable();

        return [
            'activatable_id' => $activatable::factory(),
            'activatable_type' => $activatable,
            'started_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Set the start date of the activation.
     *
     * @param  string|Carbon $activationDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function started($activationDate = 'now'): Factory
    {
        return $this->state([
            'started_at' => $activationDate instanceof Carbon ? $activationDate : new Carbon($activationDate),
        ]);
    }

    /**
     * Set the deactivation date of the activation.
     *
     * @param  string|Carbon $deactivationDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ended($deactivationDate = 'now'): Factory
    {
        return $this->state([
            'ended_at' => $deactivationDate instanceof Carbon ? $deactivationDate : new Carbon($deactivationDate),
        ]);
    }

    /**
     * Retrieve a random activatable model.
     *
     * @return mixed
     */
    public function activatable(): mixed
    {
        return $this->faker->randomElement([
            Stable::class,
            Title::class,
        ]);
    }
}
