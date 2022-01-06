<?php

namespace App\Http\Livewire\Titles;

use App\Models\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ActiveTitles extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    public $perPage = 10;

    /**
     * @return string
     */
    public function paginationView()
    {
        return 'pagination.datatables';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $activeTitles = Title::query()
            ->active()
            ->withFirstActivatedAtDate()
            ->orderByFirstActivatedAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.titles.active-titles', [
            'activeTitles' => $activeTitles,
        ]);
    }
}
