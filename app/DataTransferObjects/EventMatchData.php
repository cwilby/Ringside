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
    public Collection $wrestlers;
    public Collection $tagTeams;
    public ?string $preview;

    public static function fromStoreRequest(StoreRequest $request): self
    {
        $dto = new self;
        // dd($request->input('competitors'));

        $dto->matchType = MatchType::find($request->input('match_type_id'));
        $dto->referees = Referee::findMany($request->input('referees'));
        $dto->titles = Title::findMany($request->input('titles'));

        $wrestlers = collect();
        $tagTeams = collect();
        $competitors = collect();
        foreach ($request->input('competitors') as $competitor) {
            if ($competitor['competitor_type'] == 'wrestler') {
                $wrestler = Wrestler::find($competitor['competitor_id']);
                $competitors['wrestlers'] = $wrestlers->push($wrestler);
            }
        }
        // $competitors[]['wrestlers'] = $wrestlers;
        dd($competitors);
        // dd($wrestlers);
        $dto->competitors = self::getWrestlers($request->input('competitors'));
        $dto->competitors = self::getTagTeams($request->input('competitors'));
        $dto->preview = $request->input('preview');

        dd($dto);

        return $dto;
    }

    public static function fromUpdateRequest(UpdateRequest $request): self
    {
        $dto = new self;

        $dto->matchType = MatchType::find($request->input('match_type_id'));
        $dto->referees = Referee::findMany($request->input('referees'));
        $dto->titles = Title::findMany($request->input('titles'));
        $dto->competitors->wrestlers = self::getWrestlers($request->input('competitors'));
        $dto->competitors->tagTeams = self::getTagTeams($request->input('competitors'));
        $dto->preview = $request->input('preview');

        return $dto;
    }

    public static function getWrestlers($competitors)
    {
        $wrestlers = array_filter($competitors, static function ($contestant) {
            return $contestant['competitor_type'] === 'wrestler';
        });

        $wrestler_ids = array_column($wrestlers, 'competitor_id');

        return Wrestler::findMany($wrestler_ids);
    }

    public static function getTagTeams($competitors)
    {
        $tagTeams = array_filter($competitors, static function ($contestant) {
            return $contestant['competitor_type'] === 'tag_teams';
        });

        $tag_team_ids = array_column($tagTeams, 'competitor_id');

        return TagTeam::findMany($tag_team_ids);
    }
}
