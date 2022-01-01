<?php

namespace App\Http\Controllers\Wrestlers;

use App\Actions\Wrestlers\RetireAction;
use App\Exceptions\CannotBeRetiredException;
use App\Http\Controllers\Controller;
use App\Models\Wrestler;

class RetireController extends Controller
{
    /**
     * Retire a wrestler.
     *
     * @param  \App\Models\Wrestler  $wrestler
     * @param  \App\Actions\Wrestlers\RetireAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Wrestler $wrestler, RetireAction $action)
    {
        $this->authorize('retire', $wrestler);

        throw_unless($wrestler->canBeRetired(), new CannotBeRetiredException);

        $action->handle($wrestler);

        return redirect()->route('wrestlers.index');
    }
}
