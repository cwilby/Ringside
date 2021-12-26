<?php

namespace Database\Factories;

use App\Enums\StableStatus;
use App\Models\Activation;
use App\Models\Employment;
use App\Models\Retirement;
use App\Models\Stable;
use App\Models\TagTeam;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Stable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        /** @var string */
        $name = $this->faker->words(2, true);

        return [
            'name' => Str::title($name),
            'status' => StableStatus::unactivated(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Stable $stable) {
            $stable->currentWrestlers->each->save();
            $stable->currentTagTeams->each->save();
            $stable->save();
        });
    }

    /**
     * Generate a stable with a future activation.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureActivation(): Factory
    {
        return $this->state(['status' => StableStatus::future_activation()])
            ->has(Activation::factory()->started(Carbon::tomorrow()))
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started(Carbon::tomorrow())), ['joined_at' => now()])
            ->hasAttached(TagTeam::factory()->has(Employment::factory()->started(Carbon::tomorrow())), ['joined_at' => now()]);
    }

    /**
     * Generate an unactivated stable.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unactivated(): Factory
    {
        return $this->state(['status' => StableStatus::unactivated()])
            ->hasAttached(Wrestler::factory()->unemployed(), ['joined_at' => now()])
            ->hasAttached(TagTeam::factory()->unemployed(), ['joined_at' => now()]);
    }

    /**
     * Generate an active stable.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active(): Factory
    {
        $activationDate = Carbon::yesterday();

        return $this->state(['status' => StableStatus::active()])
            ->has(Activation::factory()->started($activationDate))
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started($activationDate)), ['joined_at' => $activationDate])
            ->hasAttached(TagTeam::factory()->has(Employment::factory()->started($activationDate)), ['joined_at' => $activationDate]);
    }

    /**
     * Generate an inactive stable.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => StableStatus::inactive()])
            ->has(Activation::factory()->started($start)->ended($end))
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started($start)), ['joined_at' => $start, 'left_at' => $end])
            ->hasAttached(TagTeam::factory()->has(Employment::factory()->started($start)), ['joined_at' => $start, 'left_at' => $end]);
    }

    /**
     * Generate a retired stable.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function retired(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(3);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => StableStatus::retired()])
            ->hasActivations(1, ['started_at' => $start, 'ended_at' => $end])
            ->hasRetirements(1, ['started_at' => $end])
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started($start)->ended($end))->has(Retirement::factory()->started($end)), ['joined_at' => $start])
            ->hasAttached(TagTeam::factory()->has(Employment::factory()->started($start)->ended($end))->has(Retirement::factory()->started($end)), ['joined_at' => $start]);
    }

    /**
     * Generate a soft deleted stable.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
