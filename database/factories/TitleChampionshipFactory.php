<?php

namespace Database\Factories;

use App\Models\TitleChampionship;
use Illuminate\Database\Eloquent\Factories\Factory;

class TitleChampionshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TitleChampionship::class;

    /**
     * Indicate the date the title was won.
     *
     * @param  string $date
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function wonOn(string $date)
    {
        return $this->state(['won_at' => $date]);
    }

    /**
     * Indicate the date the title was lost.
     *
     * @param  ?string $date
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function lostOn(?string $date)
    {
        return $this->state(['lost_at' => $date]);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_id' => Title::factory(),
            'match_id' => Match::factory(),
        ];
    }
}
