<?php

namespace App\Http\Livewire\Titles;

use App\Models\Title;
use Livewire\Component;
use Livewire\WithPagination;

class InactiveTitles extends Component
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
        $inactiveTitles = Title::query()
            ->inactive()
            ->withLastDeactivationDate()
            ->orderByLastDeactivationDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.titles.inactive-titles', [
            'inactiveTitles' => $inactiveTitles,
        ]);
    }
}
