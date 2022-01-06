<?php

namespace App\Http\Livewire\Wrestlers;

use App\Models\Wrestler;
use Livewire\Component;
use Livewire\WithPagination;

class RetiredWrestlers extends Component
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
        $retiredWrestlers = Wrestler::query()
            ->retired()
            ->withCurrentRetiredAtDate()
            ->orderByCurrentRetiredAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.wrestlers.retired-wrestlers', [
            'retiredWrestlers' => $retiredWrestlers,
        ]);
    }
}
