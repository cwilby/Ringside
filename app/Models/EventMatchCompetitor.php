<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class EventMatchCompetitor extends MorphPivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['event_match_id', 'competitor_id', 'competitor_type'];

    /**
     * @returns \Illuminate\Database\Eloquent\Relations\MorphTO
     */
    public function competitor()
    {
        $this->morphTo();
    }
}
