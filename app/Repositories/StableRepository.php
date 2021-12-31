<?php

namespace App\Repositories;

use App\DataTransferObjects\StableData;
use App\Models\Stable;
use App\Models\TagTeam;
use App\Models\Wrestler;
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
     * @param  string $activationDate
     * @return \App\Models\Stable $stable
     */
    public function activate(Stable $stable, string $activationDate): Stable
    {
        $stable->activations()->updateOrCreate(['ended_at' => null], ['started_at' => $activationDate]);

        return $stable;
    }

    /**
     * Deactivate a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  string $deactivationDate
     * @return \App\Models\Stable $stable
     */
    public function deactivate(Stable $stable, string $deactivationDate): Stable
    {
        $stable->currentActivation()->update(['ended_at' => $deactivationDate]);

        return $stable;
    }

    /**
     * Retire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  string $retirementDate
     * @return \App\Models\Stable $stable
     */
    public function retire(Stable $stable, string $retirementDate): Stable
    {
        $stable->retirements()->create(['started_at' => $retirementDate]);

        return $stable;
    }

    /**
     * Unretire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  string $unretireDate
     * @return \App\Models\Stable $stable
     */
    public function unretire(Stable $stable, string $unretireDate): Stable
    {
        $stable->currentRetirement()->update(['ended_at' => $unretireDate]);

        return $stable;
    }

    /**
     * Unretire a given stable on a given date.
     *
     * @param  \App\Models\Stable $stable
     * @param  string $unretireDate
     * @return \App\Models\Stable $stable
     */
    public function disassemble(Stable $stable, string $deactivationDate): Stable
    {
        $stable->currentWrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->updateExistingPivot($wrestler, ['left_at' => $deactivationDate])->save()
        );

        $stable->currentTagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->updateExistingPivot($tagTeam, ['left_at' => $deactivationDate])->save()
        );

        return $stable;
    }

    /**
     * Add wrestlers to a given stable.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection  $wrestlers
     * @param  string  $joinDate
     * @return \App\Models\Stable  $stable
     */
    public function addWrestlers(Stable $stable, Collection $wrestlers, string $joinDate): Stable
    {
        $wrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->attach($wrestler->id, ['joined_at' => $joinDate])
        );

        return $stable;
    }

    /**
     * Add tag teams to a given stable at a given date.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection  $tagTeams
     * @param  string  $joinDate
     * @return \App\Models\Stable  $stable
     */
    public function addTagTeams(Stable $stable, Collection $tagTeams, string $joinDate): Stable
    {
        $tagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->attach($tagTeam->id, ['joined_at' => $joinDate])
        );

        return $stable;
    }

    /**
     * Undocumented function.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection $wrestlers
     * @param  string $removalDate
     * @return \App\Models\Stable  $stable
     */
    public function removeWrestlers(Stable $stable, Collection $wrestlers, string $removalDate): Stable
    {
        $wrestlers->each(
            fn (Wrestler $wrestler) => $stable->currentWrestlers()->updateExistingPivot($wrestler->id, ['left_at' => $removalDate])
        );

        return $stable;
    }

    /**
     * Undocumented function.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection $currentTagTeams
     * @param  string $removalDate
     * @return \App\Models\Stable  $table
     */
    public function removeTagTeams(Stable $stable, Collection $currentTagTeams, string $removalDate)
    {
        $currentTagTeams->each(
            fn (TagTeam $tagTeam) => $stable->currentTagTeams()->updateExistingPivot($tagTeam->id, ['left_at' => $removalDate])
        );

        return $stable;
    }
}
