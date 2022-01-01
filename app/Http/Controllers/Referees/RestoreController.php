<?php

namespace App\Http\Controllers\Referees;

use App\Http\Controllers\Controller;
use App\Models\Referee;
use App\Services\RefereeService;

class RestoreController extends Controller
{
    /**
     * Restore a deleted referee.
     *
     * @param  int  $refereeId
     * @param  \App\Services\RefereeService $refereeService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $refereeId, RefereeService $refereeService)
    {
        /** @var \App\Models\Referee $referee */
        $referee = Referee::onlyTrashed()->findOrFail($refereeId);

        $this->authorize('restore', Referee::class);

        $refereeService->restore($referee);

        return redirect()->route('referees.index');
    }
}
