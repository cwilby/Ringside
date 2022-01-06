<?php

namespace App\Http\Livewire\Referees;

use App\Models\Referee;
use Livewire\Component;
use Livewire\WithPagination;

class SuspendedReferees extends Component
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
        $suspendedReferees = Referee::query()
            ->suspended()
            ->withCurrentSuspendedAtDate()
            ->orderByCurrentSuspendedAtDate()
            ->orderBy('last_name')
            ->paginate($this->perPage);

        return view('livewire.referees.suspended-referees', [
            'suspendedReferees' => $suspendedReferees,
        ]);
    }
}
