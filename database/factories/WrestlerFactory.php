<?php

namespace Database\Factories;

use App\Enums\WrestlerStatus;
use App\Models\Employment;
use App\Models\Injury;
use App\Models\Retirement;
use App\Models\Suspension;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WrestlerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Wrestler::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @psalm-suppress UndefinedMagicMethod
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => $this->faker->name(),
            'height' => $this->faker->numberBetween(60, 95),
            'weight' => $this->faker->numberBetween(180, 500),
            'hometown' => $this->faker->city().', '.$this->faker->state(),
            'signature_move' => null,
            'status' => WrestlerStatus::unemployed(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(fn (Wrestler $wrestler) => $wrestler->save());
    }

    /**
     * Generate a bookable wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bookable(): Factory
    {
        return $this->state(['status' => WrestlerStatus::bookable()])
            ->has(Employment::factory()->started(Carbon::yesterday()));
    }

    /**
     * Generate a wrestler with a future employment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureEmployment(): Factory
    {
        return $this->state(['status' => WrestlerStatus::future_employment()])
            ->has(Employment::factory()->started(Carbon::tomorrow()));
    }

    /**
     * Generate a unemployed wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unemployed(): Factory
    {
        return $this->state(['status' => WrestlerStatus::unemployed()]);
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

        return $this->state(['status' => WrestlerStatus::retired()])
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
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => WrestlerStatus::released()])
            ->has(Employment::factory()->started($start)->ended($end));
    }

    /**
     * Generate a suspended wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => WrestlerStatus::suspended()])
            ->has(Employment::factory()->started($start))
            ->has(Suspension::factory()->started($end));
    }

    /**
     * Generate an injured wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function injured(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);

        return $this->state(['status' => WrestlerStatus::injured()])
            ->has(Employment::factory()->started($start))
            ->has(Injury::factory()->started($now));
    }

    /**
     * Generate a soft deleted wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
