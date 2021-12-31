<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Stables\StoreRequest;
use App\Http\Requests\Stables\UpdateRequest;
use Illuminate\Support\Collection;

class StableData
{
    public string $name;
    public ?string $signature_move;
    public ?string $start_date;
    public Collection $tagTeams;
    public Collection $wrestlers;

    public static function fromStoreRequest(StoreRequest $request): self
    {
        $dto = new self;

        $dto->name = $request->input('name');
        $dto->start_date = $request->input('started_at');
        $dto->tagTeams = TagTeam::findMany($request->input('tag_teams'));
        $dto->wrestlers = Wrestler::findMany($request->input('wrestlers'));

        return $dto;
    }

    public static function fromUpdateRequest(UpdateRequest $request): self
    {
        $dto = new self;

        $dto->name = $request->input('name');
        $dto->start_date = $request->input('started_at');
        $dto->tagTeams = TagTeam::findMany($request->input('tag_teams'));
        $dto->wrestlers = Wrestler::findMany($request->input('wrestlers'));

        return $dto;
    }
}
