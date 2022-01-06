<?php

namespace App\Http\Livewire\TagTeams;

use App\Models\TagTeam;
use Livewire\Component;
use Livewire\WithPagination;

class ReleasedTagTeams extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    public $perPage = 10;

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $releasedTagTeams = TagTeam::released()
            ->withReleasedAtDate()
            ->paginate($this->perPage);

        return view('livewire.tagteams.released-tagteams', [
            'releasedTagTeams' => $releasedTagTeams,
        ]);
    }
}
