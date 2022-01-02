<?php

namespace App\Repositories;

use App\DataTransferObjects\ManagerData;
use App\Models\Manager;
use Carbon\Carbon;

class ManagerRepository
{
    /**
     * Create a new manager with the given data.
     *
     * @param  \App\DataTransferObjects\ManagerData $managerData
     * @return \App\Models\Manager
     */
    public function create(ManagerData $managerData): Manager
    {
        return Manager::create([
            'first_name' => $managerData->first_name,
            'last_name' => $managerData->last_name,
        ]);
    }

    /**
     * Update a given manager with the given data.
     *
     * @param  \App\Models\Manager $manager
     * @param  \App\DataTransferObjects\ManagerData $managerData
     * @return \App\Models\Manager $manager
     */
    public function update(Manager $manager, ManagerData $managerData): Manager
    {
        $manager->update([
            'first_name' => $managerData->first_name,
            'last_name' => $managerData->last_name,
        ]);

        return $manager;
    }

    /**
     * Delete a given manager.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function delete(Manager $manager): void
    {
        $manager->delete();
    }

    /**
     * Restore a given manager.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function restore(Manager $manager): void
    {
        $manager->restore();
    }

    /**
     * Employ a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $employmentDate
     * @return \App\Models\Manager $manager
     */
    public function employ(Manager $manager, Carbon $employmentDate): Manager
    {
        $manager->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Release a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $releaseDate
     * @return \App\Models\Manager $manager
     */
    public function release(Manager $manager, Carbon $releaseDate): Manager
    {
        $manager->currentEmployment()->update(['ended_at' => $releaseDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Injure a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $injureDate
     * @return \App\Models\Manager $manager
     */
    public function injure(Manager $manager, Carbon $injureDate): Manager
    {
        $manager->injuries()->create(['started_at' => $injureDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Clear the current injury of a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $recoveryDate
     * @return \App\Models\Manager $manager
     */
    public function clearInjury(Manager $manager, Carbon $recoveryDate): Manager
    {
        $manager->currentInjury()->update(['ended_at' => $recoveryDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Retire a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $retirementDate
     * @return \App\Models\Manager $manager
     */
    public function retire(Manager $manager, Carbon $retirementDate): Manager
    {
        $manager->retirements()->create(['started_at' => $retirementDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Unretire a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Manager $manager
     */
    public function unretire(Manager $manager, Carbon $unretireDate): Manager
    {
        $manager->currentRetirement()->update(['ended_at' => $unretireDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Suspend a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $suspensionDate
     * @return \App\Models\Manager $manager
     */
    public function suspend(Manager $manager, Carbon $suspensionDate): Manager
    {
        $manager->suspensions()->create(['started_at' => $suspensionDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Reinstate a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $reinstatementDate
     * @return \App\Models\Manager $manager
     */
    public function reinstate(Manager $manager, Carbon $reinstatementDate): Manager
    {
        $manager->currentSuspension()->update(['ended_at' => $reinstatementDate]);

        return $manager;
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $employmentDate
     * @return \App\Models\Manager $manager
     */
    public function updateEmployment(Manager $manager, Carbon $employmentDate): Manager
    {
        $manager->futureEmployment()->update(['started_at' => $employmentDate->toDateTimeString()]);

        return $manager;
    }

    /**
     * Updates a manager's status and saves.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function removeFromCurrentTagTeams(Manager $manager): void
    {
        $manager->currentTagTeams->each(
            fn (TagTeam $tagTeam) => $manager->currentTagTeams()->updateExistingPivot($tagTeam->id, ['left_at' => now()->toDateTimeString()])
        );
    }

    /**
     * Updates a manager's status and saves.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function removeFromCurrentWrestlers(Manager $manager): void
    {
        $manager->currentWrestlers->each(
            fn (Wrestler $wrestler) => $manager->currentWrestlers()->updateExistingPivot($wrestler->id, ['left_at' => now()->toDateTimeString()])
        );
    }
}
