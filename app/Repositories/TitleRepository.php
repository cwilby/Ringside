<?php

namespace App\Repositories;

use App\DataTransferObjects\TitleData;
use App\Models\Title;
use Carbon\Carbon;

class TitleRepository
{
    /**
     * Create a new title with the given data.
     *
     * @param  \App\DataTransferObjects\TitleData $titleData
     * @return \App\Models\Title
     */
    public function create(TitleData $titleData): Title
    {
        return Title::create([
            'name' => $titleData->name,
        ]);
    }

    /**
     * Update the given title with the given data.
     *
     * @param  \App\Models\Title $title
     * @param  \App\DataTransferObjects\TitleData $titleData
     * @return \App\Models\Title $title
     */
    public function update(Title $title, TitleData $titleData): Title
    {
        $title->update([
            'name' => $titleData->name,
        ]);

        return $title;
    }

    /**
     * Delete a given title.
     *
     * @param  \App\Models\Title $title
     * @return void
     */
    public function delete(Title $title): void
    {
        $title->delete();
    }

    /**
     * Restore a given title.
     *
     * @param  \App\Models\Title $title
     * @return void
     */
    public function restore(Title $title): void
    {
        $title->restore();
    }

    /**
     * Activate a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  \Carbon\Carbon $activationDate
     * @return \App\Models\Title $title
     */
    public function activate(Title $title, Carbon $activationDate): Title
    {
        $title->activations()->updateOrCreate(['ended_at' => null], ['started_at' => $activationDate->toDateTimeString()]);

        return $title;
    }

    /**
     * Deactivate a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  \Carbon\Carbon $deactivationDate
     * @return \App\Models\Title $title
     */
    public function deactivate(Title $title, Carbon $deactivationDate): Title
    {
        $title->currentActivation()->update(['ended_at' => $deactivationDate->toDateTimeString()]);

        return $title;
    }

    /**
     * Retire a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  \Carbon\Carbon $retirementDate
     * @return \App\Models\Title $title
     */
    public function retire(Title $title, Carbon $retirementDate): Title
    {
        $title->retirements()->create(['started_at' => $retirementDate->toDateTimeString()]);

        return $title;
    }

    /**
     * Unretire a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Title $title
     */
    public function unretire(Title $title, Carbon $unretireDate): Title
    {
        $title->currentRetirement()->update(['ended_at' => $unretireDate->toDateTimeString()]);

        return $title;
    }
}
