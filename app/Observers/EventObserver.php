<?php

namespace App\Observers;

use App\Enums\EventStatus;
use App\Models\Event;

class EventObserver
{
    /**
     * Handle the Event "saved" event.
     *
     * @param  App\Models\Event $event
     * @return void
     */
    public function saving(Event $event): void
    {
        $event->status = match (true) {
            $event->isScheduled() => EventStatus::scheduled(),
            $event->isPast() => EventStatus::past(),
            default => EventStatus::unscheduled()
        };
    }
}
