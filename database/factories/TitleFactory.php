<?php

namespace Database\Factories;

use App\Enums\TitleStatus;
use App\Models\Activation;
use App\Models\Retirement;
use App\Models\Title;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Title::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::title($this->faker->unique()->words(2, true)) . ' Title',
            'status' => TitleStatus::unactivated(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(fn (Title $title) => $title->save());
    }

    /**
     * Generate an active title.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active(): Factory
    {
        $activationDate = Carbon::yesterday();

        return $this->state(['status' => TitleStatus::active()])
            ->has(Activation::factory()->started($activationDate));
    }

    /**
     * Generate an inactive title.
     *
     * @return static
     */
    public function inactive(): static
    {
        $now = now();
        $start = $now->copy()->subDays(3);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => TitleStatus::inactive()])
            ->has(Activation::factory()->started($start)->ended($end));
    }

    /**
     * Generate a title with a future activation.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureActivation(): Factory
    {
        return $this->state(['status' => TitleStatus::future_activation()])
            ->has(Activation::factory()->started(Carbon::tomorrow()));
    }

    /**
     * Generate a retired title.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function retired(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(3);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => TitleStatus::retired()])
            ->has(Activation::factory()->started($start)->ended($end))
            ->has(Retirement::factory()->started($end));
    }

    /**
     * Generate an unactivated title.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unactivated(): Factory
    {
        return $this->state(['status' => TitleStatus::unactivated()]);
    }

    /**
     * Generate a soft deleted title.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
