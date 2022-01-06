<?php

namespace App\Http\Livewire\Wrestlers;

use App\Models\Wrestler;
use Livewire\Component;
use Livewire\WithPagination;

class BookableWrestlers extends Component
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
        $bookableWrestlers = Wrestler::query()
            ->bookable()
            ->withFirstEmployedAtDate()
            ->orderByFirstEmployedAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.wrestlers.bookable-wrestlers', [
            'bookableWrestlers' => $bookableWrestlers,
        ]);
    }
}
