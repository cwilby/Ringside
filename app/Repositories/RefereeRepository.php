<?php

namespace App\Repositories;

use App\DataTransferObjects\RefereeData;
use App\Models\Referee;
use Carbon\Carbon;

class RefereeRepository
{
    /**
     * Create a new referee with the given data.
     *
     * @param  \App\DataTransferObjects\RefereeData $refereeData
     * @return \App\Models\Referee
     */
    public function create(RefereeData $refereeData)
    {
        return Referee::create([
            'first_name' => $refereeData->first_name,
            'last_name' => $refereeData->last_name,
        ]);
    }

    /**
     * Update a given referee with the given data.
     *
     * @param  \App\Models\Referee $referee
     * @param  \App\DataTransferObjects\RefereeData $refereData
     * @return \App\Models\Referee $referee
     */
    public function update(Referee $referee, RefereeData $refereeData)
    {
        return $referee->update([
            'first_name' => $refereeData->first_name,
            'last_name' => $refereeData->last_name,
        ]);
    }

    /**
     * Delete a given referee.
     *
     * @param  \App\Models\Referee $referee
     * @return void
     */
    public function delete(Referee $referee)
    {
        $referee->delete();
    }

    /**
     * Restore a given referee.
     *
     * @param  \App\Models\Referee $referee
     * @return void
     */
    public function restore(Referee $referee)
    {
        $referee->restore();
    }

    /**
     * Employ a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $employmentDate
     * @return \App\Models\Referee $referee
     */
    public function employ(Referee $referee, Carbon $employmentDate)
    {
        return $referee->employments()->updateOrCreate(['ended_at' => null], ['started_at' => $employmentDate->toDateTimeString()]);
    }

    /**
     * Release a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $releaseDate
     * @return \App\Models\Referee $referee
     */
    public function release(Referee $referee, Carbon $releaseDate)
    {
        return $referee->currentEmployment()->update(['ended_at' => $releaseDate->toDateTimeString()]);
    }

    /**
     * Injure a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $injureDate
     * @return \App\Models\Referee $referee
     */
    public function injure(Referee $referee, Carbon $injureDate)
    {
        return $referee->injuries()->create(['started_at' => $injureDate->toDateTimeString()]);
    }

    /**
     * Clear the current injury of a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $recoveryDate
     * @return \App\Models\Referee $referee
     */
    public function clearInjury(Referee $referee, Carbon $recoveryDate)
    {
        return $referee->currentInjury()->update(['ended_at' => $recoveryDate->toDateTimeString()]);
    }

    /**
     * Retire a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $retirementDate
     * @return \App\Models\Referee $referee
     */
    public function retire(Referee $referee, Carbon $retirementDate)
    {
        return $referee->retirements()->create(['started_at' => $retirementDate->toDateTimeString()]);
    }

    /**
     * Unretire a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $unretireDate
     * @return \App\Models\Referee $referee
     */
    public function unretire(Referee $referee, string $unretireDate)
    {
        return $referee->currentRetirement()->update(['ended_at' => $unretireDate->toDateTimeString()]);
    }

    /**
     * Suspend a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $suspensionDate
     * @return \App\Models\Referee $referee
     */
    public function suspend(Referee $referee, Carbon $suspensionDate)
    {
        return $referee->suspensions()->create(['started_at' => $suspensionDate->toDateTimeString()]);
    }

    /**
     * Reinstate a given referee on a given date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $reinstateDate
     * @return \App\Models\Referee $referee
     */
    public function reinstate(Referee $referee, Carbon $reinstateDate)
    {
        return $referee->currentSuspension()->update(['ended_at' => $reinstateDate->toDateTimeString()]);
    }

    /**
     * Get the model's first employment date.
     *
     * @param  \App\Models\Referee $referee
     * @param  \Carbon\Carbon $employmentDate
     * @return \App\Models\Referee $referee
     */
    public function updateEmployment(Referee $referee, Carbon $employmentDate)
    {
        return $referee->futureEmployment()->update(['started_at' => $employmentDate->toDateTimeString()]);
    }
}
