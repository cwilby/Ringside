<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventMatch;
use App\Models\MatchType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventMatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventMatch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => Event::factory(),
            'match_type_id' => MatchType::factory(),
            'preview' => null,
        ];
    }
}
