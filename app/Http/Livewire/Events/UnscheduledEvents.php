<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class UnscheduledEvents extends Component
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
        $unscheduledEvents = Event::query()
            ->unscheduled()
            ->paginate($this->perPage);

        return view('livewire.events.unscheduled-events', [
            'unscheduledEvents' => $unscheduledEvents,
        ]);
    }
}
