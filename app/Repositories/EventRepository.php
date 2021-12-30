<?php

namespace App\Repositories;

use App\DataTransferObjects\EventData;
use App\Models\Event;

class EventRepository
{
    /**
     * Create a new event with the given data.
     *
     * @param  \App\DataTransferObjects\EventData $eventData
     * @return \App\Models\Event
     */
    public function create(EventData $eventData)
    {
        return Event::create([
            'name' => $eventData->name,
            'date' => $eventData->date,
            'venue_id' => $eventData->venue->id,
            'preview' => $eventData->preview,
        ]);
    }

    /**
     * Update a given event with given data.
     *
     * @param  \App\Models\Event $event
     * @param  \App\DataTransferObjects\EventData $eventData
     * @return \App\Models\Event $event
     */
    public function update(Event $event, EventData $eventData): Event
    {
        $event->update([
            'name' => $eventData->name,
            'date' => $eventData->date,
            'venue_id' => $eventData->venue->id,
            'preview' => $eventData->preview,
        ]);

        return $event;
    }

    /**
     * Delete a given event.
     *
     * @param  \App\Models\Event $event
     * @return void
     */
    public function delete(Event $event): void
    {
        $event->delete();
    }

    /**
     * Restore a given event.
     *
     * @param  \App\Models\Event $event
     * @return void
     */
    public function restore(Event $event): void
    {
        $event->restore();
    }
}
