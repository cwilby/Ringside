<?php

namespace App\Repositories;

use App\DataTransferObjects\WrestlerData;
use App\Models\Wrestler;

class WrestlerRepository
{
    /**
     * Create a new wrestler with the given data.
     *
     * @param  \App\DataTransferObjects\WrestlerData $wrestlerData
     * @return \App\Models\Wrestler
     */
    public function create(WrestlerData $wrestlerData): Wrestler
    {
        return Wrestler::create([
            'name' => $wrestlerData->name,
            'height' => $wrestlerData->height,
            'weight' => $wrestlerData->weight,
            'hometown' => $wrestlerData->hometown,
            'signature_move' => $wrestlerData->signature_move,
        ]);
    }

    /**
     * Update a given wrestler with given data.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  \App\DataTransferObjects\WrestlerData $wrestlerData
     * @return \App\Models\Wrestler $wrestler
     */
    public function update(Wrestler $wrestler, WrestlerData $wrestlerData): Wrestler
    {
        $wrestler->update([
            'name' => $wrestlerData->name,
            'height' => $wrestlerData->height,
            'weight' => $wrestlerData->weight,
            'hometown' => $wrestlerData->hometown,
            'signature_move' => $wrestlerData->signature_move,
        ]);

        return $wrestler;
    }

    /**
     * Delete a given wrestler.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @return void
     */
    public function delete(Wrestler $wrestler): void
    {
        $wrestler->delete();
    }

    /**
     * Restore a given wrestler.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @return void
     */
    public function restore(Wrestler $wrestler): void
    {
        $wrestler->restore();
    }

    /**
     * Employ a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $employmentDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function employ(Wrestler $wrestler, string $employmentDate): Wrestler
    {
        $wrestler->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate]);

        return $wrestler;
    }

    /**
     * Release a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $releaseDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function release(Wrestler $wrestler, string $releaseDate): Wrestler
    {
        $wrestler->currentEmployment()->update(['ended_at' => $releaseDate]);

        return $wrestler;
    }

    /**
     * Injure a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $injureDate
     * @return \App\Models\Wrestler
     */
    public function injure(Wrestler $wrestler, string $injureDate): Wrestler
    {
        $wrestler->injuries()->create(['started_at' => $injureDate]);

        return $wrestler;
    }

    /**
     * Clear the injury of a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $recoveryDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function clearInjury(Wrestler $wrestler, string $recoveryDate): Wrestler
    {
        $wrestler->currentInjury()->update(['ended_at' => $recoveryDate]);

        return $wrestler;
    }

    /**
     * Retire a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $retirementDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function retire(Wrestler $wrestler, string $retirementDate): Wrestler
    {
        $wrestler->retirements()->create(['started_at' => $retirementDate]);

        return $wrestler;
    }

    /**
     * Unretire a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $unretireDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function unretire(Wrestler $wrestler, string $unretireDate): Wrestler
    {
        $wrestler->currentRetirement()->update(['ended_at' => $unretireDate]);

        return $wrestler;
    }

    /**
     * Suspend a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $suspensionDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function suspend(Wrestler $wrestler, string $suspensionDate): Wrestler
    {
        $wrestler->suspensions()->create(['started_at' => $suspensionDate]);

        return $wrestler;
    }

    /**
     * Reinstate a given wrestler on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $reinstateDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function reinstate(Wrestler $wrestler, string $reinstateDate): Wrestler
    {
        $wrestler->currentSuspension()->update(['ended_at' => $reinstateDate]);

        return $wrestler;
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string $employmentDate
     * @return \App\Models\Wrestler $wrestler
     */
    public function updateEmployment(Wrestler $wrestler, string $employmentDate): Wrestler
    {
        $wrestler->futureEmployment()->update(['started_at' => $employmentDate]);

        return $wrestler;
    }

    /**
     * Remove the given wrestler from their current tag team on a given date.
     *
     * @param  \App\Models\Wrestler $wrestler
     * @param  string  $removalDate
     * @return void
     */
    public function removeFromCurrentTagTeam(Wrestler $wrestler, string $removalDate): void
    {
        $wrestler->currentTagTeam()->updateExistingPivot($wrestler->currentTagTeam->id, [
            'left_at' => $removalDate,
        ]);
    }
}
