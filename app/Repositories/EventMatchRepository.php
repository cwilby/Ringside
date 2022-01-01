<?php

namespace App\Repositories;

use App\DataTransferObjects\EventMatchData;
use App\Models\Competitor;
use App\Models\Event;
use App\Models\EventMatch;
use App\Models\Referee;
use App\Models\Title;

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
        return $event->matches()->create([
            'match_type_id' => $eventMatchData->matchType->id,
            'preview' => $eventMatchData->preview,
        ]);
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\MOdels\EventMatch $match
     * @param  \App\Models\Title $title
     * @return \App\Models\EventMatch $match
     */
    public function addTitleToMatch(EventMatch $match, Title $title): EventMatch
    {
        $match->titles()->attach($title);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  \App\Models\Referee $referee
     * @return \App\Models\EventMatch $match
     */
    public function addRefereeToMatch(EventMatch $match, Referee $referee): EventMatch
    {
        $match->referees()->attach($referee);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  \App\Models\Competitor $competitor
     * @return \App\Models\EventMatch $match;
     */
    public function addCompetitorToMatch(EventMatch $match, Competitor $competitor): EventMatch
    {
        $match->competitors()->attach($competitor);

        return $match;
    }
}
