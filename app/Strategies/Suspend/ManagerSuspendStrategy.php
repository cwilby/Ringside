<?php

namespace App\Strategies\Suspend;

use App\Exceptions\CannotBeSuspendedException;
use Carbon\Carbon;

class ManagerSuspendStrategy extends BaseSuspendStrategy implements SuspendStrategyInterface
{
    public function suspend($model)
    {
        throw_unless($model->canBeSuspended(), new CannotBeSuspendedException);

        $suspensionDate = Carbon::parse($suspendedAt)->toDateTimeString() ?? now()->toDateTimeString();

        $model->suspensions()->create(['started_at' => $suspensionDate]);
        $model->updateStatusAndSave();

        if ($model->currentTagTeam) {
            $model->currentTagTeam->updateStatusAndSave();
        }
    }
}
