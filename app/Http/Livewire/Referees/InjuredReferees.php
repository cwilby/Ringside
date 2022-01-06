<?php

namespace App\Http\Livewire\Referees;

use App\Models\Referee;
use Livewire\Component;
use Livewire\WithPagination;

class InjuredReferees extends Component
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
        $injuredReferees = Referee::query()
            ->injured()
            ->withCurrentInjuredAtDate()
            ->orderByCurrentInjuredAtDate()
            ->orderBy('last_name')
            ->paginate($this->perPage);

        return view('livewire.referees.injured-referees', [
            'injuredReferees' => $injuredReferees,
        ]);
    }
}
