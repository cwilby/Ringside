<?php

namespace Database\Factories;

use App\Models\Manager;
use App\Models\Referee;
use App\Models\Suspension;
use App\Models\TagTeam;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuspensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Suspension::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        /** @var string */
        $suspendable = $this->suspendable();

        $model = app($suspendable);

        return [
            'suspendable_id' => call_user_func($model.'::factory()'),
            'suspendable_type' => 'testing',
            'started_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Set the start date of the suspension.
     *
     * @param  string|Carbon $suspensionDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function started($suspensionDate = 'now'): Factory
    {
        return $this->state([
            'started_at' => $suspensionDate instanceof Carbon ? $suspensionDate : new Carbon($suspensionDate),
        ]);
    }

    /**
     * Set the end date of the suspension.
     *
     * @param  string|Carbon $reinstateDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ended($reinstateDate = 'now'): Factory
    {
        return $this->state([
            'ended_at' => $reinstateDate instanceof Carbon ? $reinstateDate : new Carbon($reinstateDate),
        ]);
    }

    /**
     * Retrieve a random suspendable model.
     *
     * @return mixed
     */
    public function suspendable(): mixed
    {
        return $this->faker->randomElement([
            Manager::class,
            Referee::class,
            TagTeam::class,
            Wrestler::class,
        ]);
    }
}
