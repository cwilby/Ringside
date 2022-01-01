<?php

namespace App\Http\Controllers\Wrestlers;

use App\Actions\Wrestlers\SuspendAction;
use App\Exceptions\CannotBeSuspendedException;
use App\Http\Controllers\Controller;
use App\Models\Wrestler;

class SuspendController extends Controller
{
    /**
     * Suspend a wrestler.
     *
     * @param  \App\Models\Wrestler  $wrestler
     * @param  \App\Actions\Wrestlers\SuspendAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Wrestler $wrestler, SuspendAction $action)
    {
        $this->authorize('suspend', $wrestler);

        throw_unless($wrestler->canBeSuspended(), new CannotBeSuspendedException);

        $action->handle($wrestler);

        return redirect()->route('wrestlers.index');
    }
}
