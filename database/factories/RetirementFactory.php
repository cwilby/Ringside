<?php

namespace Database\Factories;

use App\Models\Manager;
use App\Models\Referee;
use App\Models\Retirement;
use App\Models\Stable;
use App\Models\TagTeam;
use App\Models\Title;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetirementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Retirement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $retiree = $this->retirable();

        return [
            'retiree_id' => $retiree::factory(),
            'retiree_type' => $retiree,
            'started_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Set the start date of the retirement.
     *
     * @param  string|Carbon $retirementDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function started($retirementDate = 'now'): Factory
    {
        return $this->state([
            'started_at' => $retirementDate instanceof Carbon ? $retirementDate : new Carbon($retirementDate),
        ]);
    }

    /**
     * Set the end date of the retirement.
     *
     * @param string|Carbon $unretireDate
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ended($unretireDate = 'now'): Factory
    {
        return $this->state([
            'ended_at' => $unretireDate instanceof Carbon ? $unretireDate : new Carbon($unretireDate),
        ]);
    }

    /**
     * Retrieve a random retirable model.
     *
     * @return mixed
     */
    public function retirable(): mixed
    {
        return $this->faker->randomElement([
            Manager::class,
            Referee::class,
            Stable::class,
            TagTeam::class,
            Title::class,
            Wrestler::class,
        ]);
    }
}
