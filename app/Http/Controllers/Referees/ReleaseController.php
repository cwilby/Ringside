<?php

namespace App\Http\Controllers\Referees;

use App\Actions\Referees\ReleaseAction;
use App\Exceptions\CannotBeReleasedException;
use App\Http\Controllers\Controller;
use App\Models\Referee;

class ReleaseController extends Controller
{
    /**
     * Release a referee.
     *
     * @param  \App\Models\Referee  $referee
     * @param  \App\Actions\Referees\ReleaseAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Referee $referee, ReleaseAction $action)
    {
        $this->authorize('release', $referee);

        throw_unless($referee->canBeReleased(), new CannotBeReleasedException);

        $action->handle($referee);

        return redirect()->route('referees.index');
    }
}
