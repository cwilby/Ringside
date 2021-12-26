<?php

namespace Database\Factories;

use App\Enums\ManagerStatus;
use App\Models\Employment;
use App\Models\Injury;
use App\Models\Manager;
use App\Models\Retirement;
use App\Models\Suspension;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Manager::class;

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
            'status' => ManagerStatus::unemployed(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(fn (Manager $manager) => $manager->save());
    }

    /**
     * Generate an available manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function available(): Factory
    {
        return $this->state(['status' => ManagerStatus::available()])
            ->has(Employment::factory()->started(Carbon::yesterday()));
    }

    /**
     * Generate a manager with a future employment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureEmployment(): Factory
    {
        return $this->state(['status' => ManagerStatus::future_employment()])
            ->has(Employment::factory()->started(Carbon::tomorrow()));
    }

    /**
     * Generate an unemployed manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unemployed(): Factory
    {
        return $this->state(['status' => ManagerStatus::unemployed()]);
    }

    /**
     * Generate a retired manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function retired(): Factory
    {
        $start = now()->subMonths(1);
        $end = now()->subDays(3);

        return $this->state(['status' => ManagerStatus::retired()])
            ->has(Employment::factory()->started($start)->ended($end))
            ->has(Retirement::factory()->started($end));
    }

    /**
     * Generate a released manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function released(): Factory
    {
        $start = now()->subMonths(1);
        $end = now()->subDays(3);

        return $this->state(['status' => ManagerStatus::released()])
            ->has(Employment::factory()->started($start)->ended($end));
    }

    /**
     * Generate a suspened manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => ManagerStatus::suspended()])
            ->has(Employment::factory()->started($start))
            ->has(Suspension::factory()->started($end));
    }

    /**
     * Generate an injured manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function injured(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);

        return $this->state(['status' => ManagerStatus::injured()])
            ->has(Employment::factory()->started($start))
            ->has(Injury::factory()->started($now));
    }

    /**
     * Generate a soft deleted manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
