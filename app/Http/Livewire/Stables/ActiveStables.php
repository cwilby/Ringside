<?php

namespace App\Http\Livewire\Stables;

use App\Models\Stable;
use Livewire\Component;
use Livewire\WithPagination;

class ActiveStables extends Component
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
        $activeStables = Stable::query()
            ->active()
            ->withFirstActivatedAtDate()
            ->orderByFirstActivatedAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.stables.active-stables', [
            'activeStables' => $activeStables,
        ]);
    }
}
