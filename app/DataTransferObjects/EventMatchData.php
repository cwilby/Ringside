<?php

namespace App\DataTransferObjects;

use App\Http\Requests\EventMatches\StoreRequest;
use App\Http\Requests\EventMatches\UpdateRequest;
use App\Models\MatchType;
use App\Models\Referee;
use App\Models\TagTeam;
use App\Models\Title;
use App\Models\Wrestler;
use Illuminate\Support\Collection;

class EventMatchData
{
    public MatchType $matchType;
    public Collection $referees;
    public ?Collection $titles;
    public Collection $competitors;
    public ?string $preview;

    public static function fromStoreRequest(StoreRequest $request): self
    {
        $dto = new self;

        $dto->matchType = MatchType::find($request->input('match_type_id'));
        $dto->referees = Referee::findMany($request->input('referees'));
        $dto->titles = Title::findMany($request->input('titles'));
        $dto->competitors = self::getCompetitors($request->input('competitors'));
        $dto->preview = $request->input('preview');

        return $dto;
    }

    public static function fromUpdateRequest(UpdateRequest $request): self
    {
        $dto = new self;

        $dto->matchType = MatchType::find($request->input('match_type_id'));
        $dto->referees = Referee::findMany($request->input('referees'));
        $dto->titles = Title::findMany($request->input('titles'));
        $dto->competitors = self::getCompetitors($request->input('competitors'));
        $dto->preview = $request->input('preview');

        return $dto;
    }

    public static function getCompetitors($competitors)
    {
        $wrestlers = array_filter($competitors, static function ($contestant) {
            return $contestant['competitor_type'] === 'wrestler';
        });

        $wrestler_ids = array_column($wrestlers, 'competitor_id');

        $wrestlers = self::getWrestlers($wrestler_ids);

        $tagTeams = array_filter($competitors, static function ($contestant) {
            return $contestant['competitor_type'] === 'tag_teams';
        });

        $tag_team_ids = array_column($tagTeams, 'competitor_id');

        $tagTeams = self::getTagTeams($tag_team_ids);

        $competitors = collect();

        return $competitors->merge($wrestlers)->merge($tagTeams);
    }

    public static function getWrestlers($wrestlerIds)
    {
        return Wrestler::findMany($wrestlerIds);
    }

    public static function getTagTeams($tagTeamIds)
    {
        return TagTeam::findMany($tagTeamIds);
    }
}
