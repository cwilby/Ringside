<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Referees\StoreRequest;
use App\Http\Requests\Referees\UpdateRequest;
use Carbon\Carbon;

class RefereeData
{
    public string $first_name;
    public string $last_name;
    public ?Carbon $start_date;

    public static function fromStoreRequest(StoreRequest $request): self
    {
        $dto = new self;

        $dto->first_name = $request->input('first_name');
        $dto->last_name = $request->input('last_name');
        $dto->start_date = $request->input('started_at');

        return $dto;
    }

    public static function fromUpdateRequest(UpdateRequest $request): self
    {
        $dto = new self;

        $dto->first_name = $request->input('first_name');
        $dto->last_name = $request->input('last_name');
        $dto->start_date = $request->input('started_at');

        return $dto;
    }
}
