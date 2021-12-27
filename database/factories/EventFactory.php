<?php

namespace Database\Factories;

use App\Enums\EventStatus;
use App\Models\Event;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'date' => null,
            'status' => EventStatus::unscheduled(),
            'venue_id' => null,
            'preview' => null,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(fn (Event $event) => $event->save());
    }

    /**
     * Generate an unschedule event.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unscheduled(): Factory
    {
        return $this->state([
            'status' => EventStatus::unscheduled(),
            'date' => null,
        ]);
    }

    /**
     * Generate a future event.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function future(): Factory
    {
        return $this->state([
            'status' => EventStatus::scheduled(),
            'date' => Carbon::tomorrow(),
        ]);
    }

    /**
     * Generate an event in the past.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function past(): Factory
    {
        return $this->state([
            'status' => EventStatus::past(),
            'date' => Carbon::yesterday(),
        ]);
    }

    /**
     * Set the venue for the event.
     *
     * @param  \App\Models\Venue $venue
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function atVenue(Venue $venue): Factory
    {
        return $this->state([
            'venue_id' => $venue->id,
        ]);
    }

    /**
     * Set the date for the event.
     *
     * @param  string $date
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function scheduledOn($date): Factory
    {
        return $this->state(['date' => $date]);
    }

    /**
     * Set the name for the event.
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withName($name): Factory
    {
        return $this->state(['name' => $name]);
    }

    /**
     * Set the preview for the event.
     *
     * @param  string $preview
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withPreview($preview): Factory
    {
        return $this->state(['preview' => $preview]);
    }

    /**
     * Generate a soft deleted event.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function softDeleted(): Factory
    {
        return $this->state(['deleted_at' => now()]);
    }
}
