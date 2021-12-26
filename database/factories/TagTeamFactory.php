<?php

namespace Database\Factories;

use App\Enums\TagTeamStatus;
use App\Models\Employment;
use App\Models\Retirement;
use App\Models\Suspension;
use App\Models\TagTeam;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagTeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = TagTeam::class;

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
            'signature_move' => null,
            'status' => TagTeamStatus::unemployed(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        // return $this->afterCreating(function (TagTeam $tagTeam) {
        //     if ($tagTeam->wrestlers->isEmpty()) {
        //         $wrestlers = Wrestler::factory()->count(2)->create();
        //         foreach ($wrestlers as $wrestler) {
        //             $tagTeam->wrestlers()->attach($wrestler->id, ['joined_at' => now()->toDateTimeString()]);
        //         }
        //     }
        // });

        return $this->afterCreating(function (TagTeam $tagTeam) {
            $tagTeam->currentWrestlers->each->save();
            $tagTeam->save();
        });
    }

    /**
     * Generate a bookable tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bookable(): Factory
    {
        $start = now()->subDays(3);

        return $this->state(['status' => TagTeamStatus::bookable()])
            ->has(Employment::factory()->started($start))
            ->hasAttached(Wrestler::factory()->count(2)->has(Employment::factory()->started($start))->bookable(), ['joined_at' => $start]);
    }

    /**
     * Generate an unbookable tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unbookable(): Factory
    {
        $start = Carbon::yesterday();

        return $this->state(['status' => TagTeamStatus::unbookable()])
            ->has(Employment::factory()->started($start))
            ->hasAttached(Wrestler::factory()->count(2)->has(Employment::factory()->started($start))->injured(), ['joined_at' => Carbon::yesterday()]);
    }

    /**
     * Generate a tag team with a future employment.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFutureEmployment(): Factory
    {
        $start = Carbon::tomorrow();

        return $this->state(['status' => TagTeamStatus::future_employment()])
            ->has(Employment::factory()->started($start))
            ->hasAttached(Wrestler::factory()->count(2)->has(Employment::factory()->started($start)), ['joined_at' => Carbon::now()]);
    }

    /**
     * Generate a suspended tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => TagTeamStatus::suspended()])
            ->has(Employment::factory()->started($start))
            ->has(Suspension::factory()->started($end))
            ->hasAttached(Wrestler::factory()->count(2)->suspended(), ['joined_at' => $start]);
    }

    /**
     * Generate a retired tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function retired(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => TagTeamStatus::retired()])
            ->has(Employment::factory()->started($start)->ended($end))
            ->has(Retirement::factory()->started($end))
            ->hasAttached(Wrestler::factory()->count(2)->retired(), ['joined_at' => $start]);
    }

    /**
     * Generate an unemployed tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unemployed(): Factory
    {
        return $this->state(['status' => TagTeamStatus::unemployed()])
            ->hasAttached(Wrestler::factory()->count(2), ['joined_at' => Carbon::now()]);
    }

    /**
     * Generate a released tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function released(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);
        $end = $now->copy()->subDays(1);

        return $this->state(['status' => TagTeamStatus::released()])
            ->has(Employment::factory()->started($start)->ended($end))
            ->hasAttached(Wrestler::factory()->count(2)->has(Employment::factory()->started($start)->ended($end)), ['joined_at' => $start]);
    }

    /**
     * Generate an unbookabble tag team with an injured wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withInjuredWrestler(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);

        return $this->state(['status' => TagTeamStatus::unbookable()])
            ->has(Employment::factory()->started($start))
            ->hasAttached(Wrestler::factory()->injured()->has(Employment::factory()->started($start)), ['joined_at' => $start])
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started($start)), ['joined_at' => $start]);
    }

    /**
     * Generate an unbookable tag team with a suspended wrestler.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withSuspendedWrestler(): Factory
    {
        $now = now();
        $start = $now->copy()->subDays(2);

        return $this->state(['status' => TagTeamStatus::unbookable()])
            ->has(Employment::factory()->started($start))
            ->hasAttached(Wrestler::factory()->suspended()->has(Employment::factory()->started($start)), ['joined_at' => $start])
            ->hasAttached(Wrestler::factory()->has(Employment::factory()->started($start)), ['joined_at' => $start]);
    }

    /**
     * Generate a soft deleted tag team.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
