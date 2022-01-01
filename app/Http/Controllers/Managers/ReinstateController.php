<?php

namespace App\Http\Controllers\Managers;

use App\Actions\Managers\ReinstateAction;
use App\Exceptions\CannotBeReinstatedException;
use App\Http\Controllers\Controller;
use App\Models\Manager;

class ReinstateController extends Controller
{
    /**
     * Reinstate a suspended manager.
     *
     * @param  \App\Models\Manager  $manager
     * @param  \App\Actions\Managers\ReinstateAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Manager $manager, ReinstateAction $action)
    {
        $this->authorize('reinstate', $manager);

        throw_unless($manager->canBeReinstated(), new CannotBeReinstatedException);

        $action->handle($manager);

        return redirect()->route('managers.index');
    }
}
