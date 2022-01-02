<?php

namespace App\Repositories;

use App\DataTransferObjects\EventMatchData;
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
            'match_type_id' => $eventMatchData->matchType->id,
            'preview' => $eventMatchData->preview,
        ]);
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $titleId
     * @return \App\Models\EventMatch $match
     */
    public function addTitleToMatch(EventMatch $match, int $titleId)
    {
        $match->titles()->attach($titleId);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $refereeId
     * @return \App\Models\EventMatch $match
     */
    public function addRefereeToMatch(EventMatch $match, int $refereeId)
    {
        $match->referees()->attach($refereeId);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $competitorId
     * @return \App\Models\EventMatch $match
     */
    public function addCompetitorToMatch(EventMatch $match, int $competitorId)
    {
        $match->competitors()->attach($competitorId);

        return $match;
    }
}
