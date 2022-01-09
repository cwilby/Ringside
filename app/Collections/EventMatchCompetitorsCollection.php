<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Collection;

class EventMatchCompetitorsCollection extends Collection
{
    /**
     * Undocumented function.
     *
     * @return void
     */
    public function groupBySide()
    {
        return $this->groupBy('side_number');
    }

    public function groupByType()
    {
        return $this->keyBy('event_match_competitor_type');
    }

    public function filterByType($type)
    {
        return $this->filter(function ($value, $key) use ($type) {
            if ($key == $type) {
                return true;
            }
        });
    }
}
