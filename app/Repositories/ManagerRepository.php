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
    public function create(ManagerData $managerData)
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
    public function update(Manager $manager, ManagerData $managerData)
    {
        return $manager->update([
            'first_name' => $managerData->first_name,
            'last_name' => $managerData->last_name,
        ]);
    }

    /**
     * Delete a given manager.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function delete(Manager $manager)
    {
        $manager->delete();
    }

    /**
     * Restore a given manager.
     *
     * @param  \App\Models\Manager $manager
     * @return void
     */
    public function restore(Manager $manager)
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
    public function employ(Manager $manager, Carbon $employmentDate)
    {
        return $manager->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate->toDateTimeString()]);
    }

    /**
     * Release a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $releaseDate
     * @return \App\Models\Manager $manager
     */
    public function release(Manager $manager, Carbon $releaseDate)
    {
        return $manager->currentEmployment()->update(['ended_at' => $releaseDate->toDateTimeString()]);
    }

    /**
     * Injure a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $injureDate
     * @return \App\Models\Manager $manager
     */
    public function injure(Manager $manager, Carbon $injureDate)
    {
        return $manager->injuries()->create(['started_at' => $injureDate->toDateTimeString()]);
    }

    /**
     * Clear the current injury of a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $recoveryDate
     * @return \App\Models\Manager $manager
     */
    public function clearInjury(Manager $manager, string $recoveryDate)
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
    public function retire(Manager $manager, string $retirementDate)
    {
        return $manager->retirements()->create(['started_at' => $retirementDate->toDateTimeString()]);
    }

    /**
     * Unretire a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Manager $manager
     */
    public function unretire(Manager $manager, string $unretireDate)
    {
        return $manager->currentRetirement()->update(['ended_at' => $unretireDate->toDateTimeString()]);
    }

    /**
     * Suspend a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $suspensionDate
     * @return \App\Models\Manager $manager
     */
    public function suspend(Manager $manager, string $suspensionDate)
    {
        return $manager->suspensions()->create(['started_at' => $suspensionDate->toDateTimeString()]);
    }

    /**
     * Reinstate a given manager on a given date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $reinstateDate
     * @return \App\Models\Manager $manager
     */
    public function reinstate(Manager $manager, Carbon $reinstateDate)
    {
        return $manager->currentSuspension()->update(['ended_at' => $reinstateDate->toDateTimeString()]);
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\Manager $manager
     * @param  \Carbon\Carbon $employmentDate
     * @return \App\Models\Manager $manager
     */
    public function updateEmployment(Manager $manager, Carbon $employmentDate)
    {
        return $manager->futureEmployment()->update(['started_at' => $employmentDate->toDateTimeString()]);
    }

    /**
     * Updates a manager's status and saves.
     *
     * @return void
     */
    public function removeFromCurrentTagTeams($manager)
    {
        foreach ($manager->currentTagTeams as $tagTeam) {
            $manager->currentTagTeams()->updateExistingPivot($tagTeam->id, [
                'left_at' => now(),
            ]);
        }
    }

    /**
     * Updates a manager's status and saves.
     *
     * @return void
     */
    public function removeFromCurrentWrestlers($manager)
    {
        foreach ($manager->currentWrestlers as $wrestler) {
            $manager->currentWrestlers()->updateExistingPivot($wrestler->id, [
                'left_at' => now(),
            ]);
        }
    }
}
