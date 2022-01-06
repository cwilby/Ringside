<?php

namespace App\Http\Livewire\Titles;

use App\Models\Title;
use Livewire\Component;
use Livewire\WithPagination;

class RetiredTitles extends Component
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
        $retiredTitles = Title::query()
            ->retired()
            ->withCurrentRetiredAtDate()
            ->orderByCurrentRetiredAtDate()
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.titles.retired-titles', [
            'retiredTitles' => $retiredTitles,
        ]);
    }
}
