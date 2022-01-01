<?php

namespace App\Http\Controllers\Stables;

use App\Actions\Stables\RetireAction;
use App\Exceptions\CannotBeRetiredException;
use App\Http\Controllers\Controller;
use App\Models\Stable;

class RetireController extends Controller
{
    /**
     * Retire a stable.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \App\Actions\Stables\RetireAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Stable $stable, RetireAction $action)
    {
        $this->authorize('retire', $stable);

        throw_unless($stable->canBeRetired(), new CannotBeRetiredException);

        $action->handle($stable);

        return redirect()->route('stables.index');
    }
}
