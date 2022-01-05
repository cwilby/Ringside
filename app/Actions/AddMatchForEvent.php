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

        foreach ($eventMatchData->competitors as $sideNumber => $sideCompetitors) {
            if (array_key_exists('wrestlers', $sideCompetitors)) {
                foreach ($sideCompetitors as $wrestlers) {
                    foreach ($wrestlers as $wrestler) {
                        $this->eventMatchRepository->addWrestlerToMatch($createdMatch, $wrestler, $sideNumber);
                    }
                }
            } elseif (array_key_exists('tag_teams', $sideCompetitors)) {
                foreach ($sideCompetitors as $tagTeams) {
                    foreach ($tagTeams as $tagTeam) {
                        $this->eventMatchRepository->addTagTeamToMatch($createdMatch, $tagTeam, $sideNumber);
                    }
                }
            }
        }

        return $createdMatch;
    }
}
