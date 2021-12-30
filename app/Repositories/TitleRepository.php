<?php

namespace App\Repositories;

use App\DataTransferObjects\TitleData;
use App\Models\Contracts\Activatable;
use App\Models\Contracts\Deactivatable;
use App\Models\Title;
use App\Repositories\Contracts\ActivationRepositoryInterface;
use App\Repositories\Contracts\DeactivationRepositoryInterface;

class TitleRepository implements ActivationRepositoryInterface, DeactivationRepositoryInterface
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
     * @param  \App\Models\Contracts\Activatable $title
     * @param  string $activationDate
     * @return \App\Models\Title $title
     */
    public function activate(Activatable $title, string $activationDate): Title
    {
        $title->activations()->updateOrCreate(['ended_at' => null], ['started_at' => $activationDate]);

        return $title;
    }

    /**
     * Deactivate a given title on a given date.
     *
     * @param  \App\Models\Contracts\Deactivatable $title
     * @param  string $deactivationDate
     * @return \App\Models\Title $title
     */
    public function deactivate(Deactivatable $title, string $deactivationDate): Title
    {
        $title->currentActivation()->update(['ended_at' => $deactivationDate]);

        return $title;
    }

    /**
     * Retire a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  string $retirementDate
     * @return \App\Models\Title $title
     */
    public function retire(Title $title, string $retirementDate): Title
    {
        $title->retirements()->create(['started_at' => $retirementDate]);

        return $title;
    }

    /**
     * Unretire a given title on a given date.
     *
     * @param  \App\Models\Title $title
     * @param  string $unretireDate
     * @return \App\Models\Title $title
     */
    public function unretire(Title $title, string $unretireDate): Title
    {
        $title->currentRetirement()->update(['ended_at' => $unretireDate]);

        return $title;
    }
}
