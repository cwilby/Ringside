<?php

namespace App\Repositories;

use App\DataTransferObjects\EventMatchData;
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
     * @param  \App\Models\Title $title
     * @return \App\Models\EventMatch $match
     */
    public function addTitleToMatch(EventMatch $match, Title $title)
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
    public function addRefereeToMatch(EventMatch $match, Referee $referee)
    {
        $match->referees()->attach($referee);

        return $match;
    }

    /**
     * Create a new event with the given data.
     *
     * @param  \App\Models\EventMatch $match
     * @param  mixed $competitor
     * @return \App\Models\EventMatch $match
     */
    public function addCompetitorToMatch(EventMatch $match, mixed $competitor)
    {
        $match->competitors()->attach($competitor->id);

        return $match;
    }
}
