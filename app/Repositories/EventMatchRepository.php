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
     * @return \App\Models\EventMatch $eventMatch
     */
    public function createForEvent(Event $event, EventMatchData $eventMatchData): EventMatch
    {
        $eventMatch = $event->matches()->create([
            'match_type_id' => $eventMatchData->matchType->id,
            'preview' => $eventMatchData->preview,
        ]);

        return $eventMatch;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\MOdels\EventMatch $match
     * @param  int $titleId
     * @return \App\Models\EventMatch $match
     */
    public function addTitleToMatch(EventMatch $match, int $titleId): EventMatch
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
    public function addRefereeToMatch(EventMatch $match, int $refereeId): EventMatch
    {
        $match->referees()->attach($refereeId);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  int $competitorId
     * @return \App\Models\EventMatch $match;
     */
    public function addCompetitorToMatch(EventMatch $match, int $competitorId): EventMatch
    {
        $match->competitors()->attach($competitorId);

        return $match;
    }
}
