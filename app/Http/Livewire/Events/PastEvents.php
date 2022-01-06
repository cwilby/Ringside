<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class PastEvents extends Component
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
        $pastEvents = Event::query()
            ->past()
            ->paginate($this->perPage);

        return view('livewire.events.past-events', [
            'pastEvents' => $pastEvents,
        ]);
    }
}
