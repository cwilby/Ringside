<?php

namespace App\Http\Livewire\Wrestlers;

use App\Models\Wrestler;
use Livewire\Component;
use Livewire\WithPagination;

class SuspendedWrestlers extends Component
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
     * Undocumented function.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $suspendedWrestlers = Wrestler::query()
            ->suspended()
            ->withCurrentSuspendedAtDate()
            ->orderByCurrentSuspendedAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.wrestlers.suspended-wrestlers', [
            'suspendedWrestlers' => $suspendedWrestlers,
        ]);
    }
}
