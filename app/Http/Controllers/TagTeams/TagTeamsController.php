<?php

namespace App\Http\Controllers\TagTeams;

use App\DataTransferObjects\TagTeamData;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagTeams\StoreRequest;
use App\Http\Requests\TagTeams\UpdateRequest;
use App\Models\TagTeam;
use App\Models\Wrestler;
use App\Services\TagTeamService;

class TagTeamsController extends Controller
{
    public TagTeamService $tagTeamService;

    /**
     * Create a new tag teams controller instance.
     *
     * @param  \App\Services\TagTeamService $tagTeamService
     */
    public function __construct(TagTeamService $tagTeamService)
    {
        $this->tagTeamService = $tagTeamService;
    }

    /**
     * View a list of tag teams.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewList', TagTeam::class);

        return view('tagteams.index');
    }

    /**
     * Show the form for creating a new tag team.
     *
     * @return \Illuminate\View\View
     */
    public function create(TagTeam $tagTeam)
    {
        $this->authorize('create', TagTeam::class);

        $wrestlers = Wrestler::get()->pluck('name', 'id');

        return view('tagteams.create', [
            'tagTeam' => $tagTeam,
            'wrestlers' => $wrestlers,
        ]);
    }

    /**
     * Create a new tag team.
     *
     * @param  \App\Http\Requests\TagTeams\StoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->tagTeamService->create(TagTeamData::fromStoreRequest($request));

        return redirect()->route('tag-teams.index');
    }

    /**
     * Show the profile of a tag team.
     *
     * @param  \App\Models\TagTeam  $tagTeam
     * @return \Illuminate\View\View
     */
    public function show(TagTeam $tagTeam)
    {
        $this->authorize('view', $tagTeam);

        return view('tagteams.show', [
            'tagTeam' => $tagTeam,
        ]);
    }

    /**
     * Show the form for editing a tag team.
     *
     * @param  \App\Models\TagTeam  $tagTeam
     * @return \Illuminate\View\View
     */
    public function edit(TagTeam $tagTeam)
    {
        $this->authorize('update', $tagTeam);

        $wrestlers = Wrestler::all();

        return view('tagteams.edit', [
            'tagTeam' => $tagTeam,
            'wrestlers' => $wrestlers,
        ]);
    }

    /**
     * Update a given tag team.
     *
     * @param  \App\Http\Requests\TagTeams\UpdateRequest  $request
     * @param  \App\Models\TagTeam  $tagTeam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, TagTeam $tagTeam)
    {
        $this->tagTeamService->update($tagTeam, TagTeamData::fromUpdateRequest($request));

        return redirect()->route('tag-teams.index');
    }

    /**
     * Delete a tag team.
     *
     * @param  \App\Models\TagTeam  $tagTeam
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TagTeam $tagTeam)
    {
        $this->authorize('delete', $tagTeam);

        $this->tagTeamService->delete($tagTeam);

        return redirect()->route('tag-teams.index');
    }
}
