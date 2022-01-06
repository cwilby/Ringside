<?php

namespace App\Http\Livewire\Wrestlers;

use App\Models\Wrestler;
use Livewire\Component;
use Livewire\WithPagination;

class FutureEmployedAndUnemployedWrestlers extends Component
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
        $futureEmploymentAndUnemployedWrestlers = Wrestler::query()
            ->futureEmployed()
            ->orWhere
            ->unemployed()
            ->withFirstEmployedAtDate()
            ->orderByNullsLast('first_employed_at')
            ->paginate();

        return view('livewire.wrestlers.future-employed-and-unemployed-wrestlers', [
            'futureEmployedAndUnemployedWrestlers' => $futureEmploymentAndUnemployedWrestlers,
        ]);
    }
}
