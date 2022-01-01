<?php

namespace App\Repositories;

use App\DataTransferObjects\StableData;
use App\Models\Stable;
use App\Models\TagTeam;
use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StableRepository
{
    /**
     * Create a new stable with the given data.
     *
     * @param  \App\DataTransferObjects\StableData $stableData
     * @return \App\Models\Stable
     */
    public function create(StableData $stableData): Stable
    {
        return Stable::create([
            'name' => $stableData->name,
        ]);
    }

    /**
     * Update the given stable with the given data.
     *
     * @param  \App\Models\Stable $stable
     * @param  \App\DataTransferObjects\StableData $stableData
     * @return \App\Models\Stable $stable
     */
    public function update(Stable $stable, StableData $stableData): Stable
    {
        $stable->update([
            'name' => $stableData->name,
        ]);

        return $stable;
    }

    /**
     * Delete a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @return void
     */
    public function delete(Stable $stable): void
    {
        $stable->delete();
    }

    /**
     * Restore a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @return void
     */
    public function restore(Stable $stable): void
    {
        $stable->restore();
    }

    /**
     * Activate a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Carbon\Carbon $activationDate
     * @return \App\Models\Stable $stable
     */
    public function activate(Stable $stable, Carbon $activationDate): Stable
    {
        $stable->activations()->updateOrCreate(['ended_at' => null], ['started_at' => $activationDate->toDateTimeString()]);

        return $stable;
    }

    /**
     * Deactivate a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Carbon\Carbon $deactivationDate
     * @return \App\Models\Stable $stable
     */
    public function deactivate(Stable $stable, Carbon $deactivationDate): Stable
    {
        $stable->currentActivation()->update(['ended_at' => $deactivationDate->toDateTimeString()]);

        return $stable;
    }

    /**
     * Retire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Carbon\Carbon $retirementDate
     * @return \App\Models\Stable $stable
     */
    public function retire(Stable $stable, Carbon $retirementDate): Stable
    {
        $stable->retirements()->create(['started_at' => $retirementDate->toDateTimeString()]);

        return $stable;
    }

    /**
     * Unretire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Stable $stable
     */
    public function unretire(Stable $stable, Carbon $unretireDate): Stable
    {
        $stable->currentRetirement()->update(['ended_at' => $unretireDate->toDateTimeString()]);

        return $stable;
    }

    /**
     * Unretire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Stable $stable
     */
    public function disassemble(Stable $stable, Carbon $deactivationDate): Stable
    {
        $stable->currentWrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->updateExistingPivot($wrestler, ['left_at' => $deactivationDate->toDateTimeString()])->save()
        );

        $stable->currentTagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->updateExistingPivot($tagTeam, ['left_at' => $deactivationDate->toDateTimeString()])->save()
        );

        return $stable;
    }

    /**
     * Add wrestlers to a given stable.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection  $wrestlers
     * @param  \Carbon\Carbon  $joinDate
     * @return \App\Models\Stable  $stable
     */
    public function addWrestlers(Stable $stable, Collection $wrestlers, Carbon $joinDate): Stable
    {
        $wrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->attach($wrestler->id, ['joined_at' => $joinDate->toDateTimeString()])
        );

        return $stable;
    }

    /**
     * Add tag teams to a given stable at a given date.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection  $tagTeams
     * @param  \Carbon\Carbon  $joinDate
     * @return \App\Models\Stable  $stable
     */
    public function addTagTeams(Stable $stable, Collection $tagTeams, Carbon $joinDate): Stable
    {
        $tagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->attach($tagTeam->id, ['joined_at' => $joinDate->toDateTimeString()])
        );

        return $stable;
    }

    /**
     * Undocumented function.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection $wrestlers
     * @param  \Carbon\Carbon $removalDate
     * @return \App\Models\Stable  $stable
     */
    public function removeWrestlers(Stable $stable, Collection $wrestlers, Carbon $removalDate): Stable
    {
        $wrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->updateExistingPivot($wrestler->id, ['left_at' => $removalDate->toDateTimeString()])
        );

        return $stable;
    }

    /**
     * Undocumented function.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection $currentTagTeams
     * @param  \Carbon\Carbon $removalDate
     * @return \App\Models\Stable  $table
     */
    public function removeTagTeams(Stable $stable, Collection $currentTagTeams, Carbon $removalDate)
    {
        $currentTagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->updateExistingPivot($tagTeam->id, ['left_at' => $removalDate->toDateTimeString()])
        );

        return $stable;
    }
}
