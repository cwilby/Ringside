<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    /**
     * @var \Illuminate\Support\Collection
     */
    public $collection;

    /**
     * Create a new component instance.
     *
     * @param  \Illuminate\Support\Collection $collection
     * @return void
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}
