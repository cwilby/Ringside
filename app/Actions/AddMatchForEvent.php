<?php

namespace App\Actions;

use App\DataTransferObjects\EventMatchData;
use App\Models\Competitor;
use App\Models\Event;
use App\Models\EventMatch;
use App\Models\Referee;
use App\Models\Title;
use App\Repositories\EventMatchRepository;

class AddMatchForEvent
{
    private ?EventMatchRepository $eventMatchRepository = null;

    public function __construct(EventMatchRepository $eventMatchRepository)
    {
        $this->eventMatchRepository = $eventMatchRepository;
    }

    /**
     * Undocumented function.
     *
     * @param  \App\Models\Event $event
     * @param  \App\DataTransferObjects\EventMatchData $eventMatchData
     * @return \App\Models\EventMatch $createdMatch
     */
    public function __invoke(Event $event, EventMatchData $eventMatchData): EventMatch
    {
        $createdMatch = $this->eventMatchRepository->createForEvent($event, $eventMatchData);

        if ($eventMatchData->titles->isNotEmpty()) {
            $eventMatchData->titles->each(
                fn (Title $title) => $this->eventMatchRepository->addTitleToMatch($createdMatch, $title)
            );
        }

        $eventMatchData->referees->each(
            fn (Referee $referee) => $this->eventMatchRepository->addRefereeToMatch($createdMatch, $referee)
        );

        $eventMatchData->competitors->each(
            fn (Competitor $competitor) => $this->eventMatchRepository->addCompetitorToMatch($createdMatch, $competitor)
        );

        return $createdMatch;
    }
}
