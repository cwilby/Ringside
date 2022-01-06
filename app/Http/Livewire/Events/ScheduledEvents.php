<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduledEvents extends Component
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
        $scheduledEvents = Event::query()
            ->scheduled()
            ->paginate($this->perPage);

        return view('livewire.events.scheduled-events', [
            'scheduledEvents' => $scheduledEvents,
        ]);
    }
}
