<?php

namespace App\Http\Controllers\Titles;

use App\Http\Controllers\Controller;
use App\Models\Title;
use App\Services\TitleService;

class RestoreController extends Controller
{
    /**
     * Restores a title.
     *
     * @param  int $titleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke($titleId, TitleService $titleService)
    {
        /** @var \App\Models\Title $title */
        $title = Title::onlyTrashed()->findOrFail($titleId);

        $this->authorize('restore', $title);

        $titleService->restore($title);

        return redirect()->route('titles.index');
    }
}
