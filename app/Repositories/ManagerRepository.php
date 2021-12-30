<?php

namespace App\Repositories;

use App\DataTransferObjects\ManagerData;
use App\Models\Manager;

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
     * @param  string $employmentDate
     * @return \App\Models\Manager $manager
     */
    public function employ(Manager $manager, string $employmentDate): Manager
    {
        $manager->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate]);

        return $manager;
    }

    /**
     * Release a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $releaseDate
     * @return \App\Models\Manager $manager
     */
    public function release(Manager $manager, string $releaseDate): Manager
    {
        $manager->currentEmployment()->update(['ended_at' => $releaseDate]);

        return $manager;
    }

    /**
     * Injure a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $injureDate
     * @return \App\Models\Manager $manager
     */
    public function injure(Manager $manager, string $injureDate): Manager
    {
        $manager->injuries()->create(['started_at' => $injureDate]);

        return $manager;
    }

    /**
     * Clear the current injury of a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $recoveryDate
     * @return \App\Models\Manager $manager
     */
    public function clearInjury(Manager $manager, string $recoveryDate): Manager
    {
        $manager->currentInjury()->update(['ended_at' => $recoveryDate]);

        return $manager;
    }

    /**
     * Retire a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $retirementDate
     * @return \App\Models\Manager $manager
     */
    public function retire(Manager $manager, string $retirementDate): Manager
    {
        $manager->retirements()->create(['started_at' => $retirementDate]);

        return $manager;
    }

    /**
     * Unretire a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $unretireDate
     * @return \App\Models\Manager $manager
     */
    public function unretire(Manager $manager, string $unretireDate): Manager
    {
        $manager->currentRetirement()->update(['ended_at' => $unretireDate]);

        return $manager;
    }

    /**
     * Suspend a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $suspensionDate
     * @return \App\Models\Manager $manager
     */
    public function suspend(Manager $manager, string $suspensionDate): Manager
    {
        $manager->suspensions()->create(['started_at' => $suspensionDate]);

        return $manager;
    }

    /**
     * Reinstate a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $reinstateDate
     * @return \App\Models\Manager $manager
     */
    public function reinstate(Manager $manager, string $reinstateDate): Manager
    {
        $manager->currentSuspension()->update(['ended_at' => $reinstateDate]);

        return $manager;
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\Manager $manager
     * @param  string $employmentDate
     * @return \App\Models\Manager $manager
     */
    public function updateEmployment(Manager $manager, string $employmentDate): Manager
    {
        $manager->futureEmployment()->update(['started_at' => $employmentDate]);

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
            fn (TagTeam $tagTeam) => $manager->currentTagTeams()->updateExistingPivot($tagTeam->id, ['left_at' => now()])
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
            fn (Wrestler $wrestler) => $manager->currentWrestlers()->updateExistingPivot($wrestler->id, ['left_at' => now()])
        );
    }
}
