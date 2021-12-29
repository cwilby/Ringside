<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventMatch;

class EventMatchRepository
{
    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\Event $event
     * @param  \App\DataTransferObjects\EventMatchData $eventMatchData
     * @return \App\Models\EventMatch
     */
    public function createForEvent(Event $event, EventMatchData $eventMatchData)
    {
        return $event->matches()->create([
            'match_type_id' => $eventMatchData->match_type_id,
            'preview' => $eventMatchData->preview,
        ]);
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\MOdels\EventMatch $match
     * @param  int $titleId
     * @return \App\Models\Event
     */
    public function addTitleToMatch(EventMatch $match, int $titleId)
    {
        return $match->titles()->attach($titleId);
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $refereeId
     * @return \App\Models\EventMatch
     */
    public function addRefereeToMatch(EventMatch $match, int $refereeId)
    {
        return $match->referees()->attach($refereeId);
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $competitorId
     * @return \App\Models\Event
     */
    public function addCompetitorToMatch(EventMatch $match, int $competitorId)
    {
        return $match->competitors()->attach($competitorId);
    }
}
