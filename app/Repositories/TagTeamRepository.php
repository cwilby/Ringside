<?php

namespace App\Repositories;

use App\DataTransferObjects\TagTeamData;
use App\Models\TagTeam;
use Illuminate\Support\Collection;

class TagTeamRepository
{
    /**
     * Create a new tag team with the given data.
     *
     * @param  \App\DataTransferObjects\TagTeamData $tagTeamData
     * @return \App\Models\TagTeam
     */
    public function create(TagTeamData $tagTeamData)
    {
        return TagTeam::create([
            'name' => $tagTeamData->name,
            'signature_move' => $tagTeamData->signature_move,
        ]);
    }

    /**
     * Update a given tag team with the given data.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  \App\DataTransferObjects\TagTeamData $tagTeamData
     * @return \App\Models\TagTeam $tagTeam
     */
    public function update(TagTeam $tagTeam, TagTeamData $tagTeamData)
    {
        return $tagTeam->update([
            'name' => $tagTeamData->name,
            'signature_move' => $tagTeamData->signature_move,
        ]);
    }

    /**
     * Delete a given tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @return void
     */
    public function delete(TagTeam $tagTeam): void
    {
        $tagTeam->delete();
    }

    /**
     * Restore a given tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @return void
     */
    public function restore(TagTeam $tagTeam): void
    {
        $tagTeam->restore();
    }

    /**
     * Employ a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $employmentDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function employ(TagTeam $tagTeam, string $employmentDate)
    {
        return $tagTeam->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate]);
    }

    /**
     * Release a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $releaseDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function release(TagTeam $tagTeam, string $releaseDate)
    {
        return $tagTeam->currentEmployment()->update(['ended_at' => $releaseDate]);
    }

    /**
     * Retire a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $retirementDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function retire(TagTeam $tagTeam, string $retirementDate)
    {
        return $tagTeam->retirements()->create(['started_at' => $retirementDate]);
    }

    /**
     * Unretire a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $unretireDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function unretire(TagTeam $tagTeam, string $unretireDate)
    {
        return $tagTeam->currentRetirement()->update(['ended_at' => $unretireDate]);
    }

    /**
     * Suspend a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $suspensionDate
     * @return App\Models\TagTeam $tagTeam
     */
    public function suspend(TagTeam $tagTeam, string $suspensionDate)
    {
        return $tagTeam->suspensions()->create(['started_at' => $suspensionDate]);
    }

    /**
     * Reinstate a given tag team on a given date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $reinstateDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function reinstate(TagTeam $tagTeam, string $reinstateDate)
    {
        return $tagTeam->currentSuspension()->update(['ended_at' => $reinstateDate]);
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $employmentDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function updateEmployment(TagTeam $tagTeam, string $employmentDate)
    {
        return $tagTeam->futureEmployment()->update(['started_at' => $employmentDate]);
    }

    /**
     * Add wrestlers to a tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  \Illuminate\Support\Collection $wrestlers
     * @param  string|null $joinDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function addWrestlers(TagTeam $tagTeam, Collection $wrestlers, string $joinDate = null)
    {
        $joinDate ??= now()->toDateString();

        $wrestlers->each(
            fn (Wrestler $wrestler) => $tagTeam->wrestlers()->attach($wrestler->id, ['joined_at' => $joinDate])
        );
    }

    /**
     * Add wrestlers to a tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  \Illuminate\Support\Collection $formerTagTeamPartners
     * @param  \Illuminate\Support\Collection $newTagTeamPartners
     * @param  string|null $date
     * @return \App\Models\TagTeam $tagTeam
     */
    public function syncTagTeamPartners(
        TagTeam $tagTeam,
        Collection $formerTagTeamPartners,
        Collection $newTagTeamPartners,
        string $date = null
    ) {
        $date ??= now()->toDateTimeString();

        $formerTagTeamPartners->each(
            fn (Wrestler $tagTeamPartner) => $tagTeam->currentWrestlers()->updateExistingPivot($tagTeamPartner, ['left_at' => $date])
        );

        $newTagTeamPartners->each(
            fn (Wrestler $newTagTeamPartner) => $tagTeam->currentWrestlers()->attach($newTagTeamPartner, ['joined_at' => $date])
        );

        return $tagTeam;
    }
}
