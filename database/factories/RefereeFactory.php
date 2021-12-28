<?php

namespace Database\Factories;

use App\Enums\RefereeStatus;
use App\Models\Employment;
use App\Models\Injury;
use App\Models\Referee;
use App\Models\Retirement;
use App\Models\Suspension;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefereeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Referee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'status' => RefereeStatus::unemployed(),
        ];
    }

    /**
     * Generate an bookable referee.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bookable(): Factory
    {
        return $this->state(['status' => RefereeStatus::bookable()])
            ->has(Employment::factory()->started(Carbon::yesterday()));
    }

    /**
     * Generate a referee with a future employment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureEmployment(): Factory
    {
        return $this->state(['status' => RefereeStatus::future_employment()])
            ->has(Employment::factory()->started(Carbon::tomorrow()));
    }

    /**
     * Generate an unemployed referee.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unemployed(): Factory
    {
        return $this->state(['status' => RefereeStatus::unemployed()]);
    }

    /**
     * Generate a retired wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function retired(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => RefereeStatus::retired()])
            ->has(Employment::factory()->started($start)->ended($end))
            ->has(Retirement::factory()->started($end));
    }

    /**
     * Generate a released wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function released(): Factory
    {
        $now = now();
        $start = $now->copy()->subWeeks(2);
        $end = $now->copy()->subWeeks(1);

        return $this->state(['status' => RefereeStatus::released()])
            ->has(Employment::factory()->started($start)->ended($end));
    }

    /**
     * Generate a suspended referee.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => RefereeStatus::suspended()])
            ->has(Employment::factory()->started($start))
            ->has(Suspension::factory()->started($end));
    }

    /**
     * Generate an injured referee.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function injured(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);

        return $this->state(['status' => RefereeStatus::injured()])
            ->has(Employment::factory()->started($start))
            ->has(Injury::factory()->started($now));
    }

    /**
     * Generate a soft deleted referee.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
