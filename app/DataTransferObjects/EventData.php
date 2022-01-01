<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Events\StoreRequest;
use App\Http\Requests\Events\UpdateRequest;
use App\Models\Venue;
use Carbon\Carbon;

class EventData
{
    public string $name;
    public ?Carbon $date;
    public ?Venue $venue;
    public ?string $preview;

    public static function fromStoreRequest(StoreRequest $request): self
    {
        $dto = new self;

        $dto->name = $request->input('name');
        $dto->date = $request->input('date');
        $dto->venue = Venue::find($request->input('venue_id'));
        $dto->preview = $request->input('preview');

        return $dto;
    }

    public static function fromUpdateRequest(UpdateRequest $request): self
    {
        $dto = new self;

        $dto->name = $request->input('name');
        $dto->date = $request->input('date');
        $dto->venue = Venue::find($request->input('venue_id'));
        $dto->preview = $request->input('preview');

        return $dto;
    }
}
