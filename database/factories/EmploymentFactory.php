<?php

namespace Database\Factories;

use App\Models\Employment;
use App\Models\Manager;
use App\Models\Referee;
use App\Models\TagTeam;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmploymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Employment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $employable = $this->employable();

        return [
            'employable_id' => $employable::factory(),
            'employable_type' => $employable,
            'started_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Set the start date of the employment.
     *
     * @param  string|Carbon $employmentDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function started($employmentDate = 'now'): Factory
    {
        return $this->state([
            'started_at' => $employmentDate instanceof Carbon ? $employmentDate : new Carbon($employmentDate),
        ]);
    }

    /**
     * Set the end date of the employment.
     *
     * @param  string|Carbon $releaseDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ended($releaseDate = 'now'): Factory
    {
        return $this->state([
            'ended_at' => $releaseDate instanceof Carbon ? $releaseDate : new Carbon($releaseDate),
        ]);
    }

    /**
     * Retrieve a random employable model.
     *
     * @return mixed
     */
    public function employable(): mixed
    {
        return $this->faker->randomElement([
            Manager::class,
            Referee::class,
            TagTeam::class,
            Wrestler::class,
        ]);
    }
}
