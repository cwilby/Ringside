<?php

namespace App\Actions;

use App\DataTransferObjects\EventMatchData;
use App\Models\Event;
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
     * @return void
     */
    public function __invoke(Event $event, EventMatchData $eventMatchData)
    {
        $createdMatch = $this->eventMatchRepository->createForEvent($event, $eventMatchData);

        if ($eventMatchData->titles->isNotEmpty()) {
            $eventMatchData->titles->map(
                fn (Title $title) => $this->eventMatchRepository->addTitleToMatch($createdMatch, $title)
            );
        }

        $eventMatchData->referees->map(
            fn (Referee $referee) => $this->eventMatchRepository->addRefereeToMatch($createdMatch, $referee)
        );

        dd($eventMatchData->competitors);

        $eventMatchData->competitors->wrestlers->map(
            fn (Wrestler $wrestler) => $this->eventMatchRepository->addWrestlerToMatch($createdMatch, $wrestler)
        );

        $eventMatchData->competitors->tagTeams->map(
            fn (TagTeam $tagTeam) => $this->eventMatchRepository->addTagTeamToMatch($createdMatch, $tagTeam)
        );

        return $createdMatch;
    }
}
