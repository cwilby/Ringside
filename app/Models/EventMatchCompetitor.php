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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function competitor()
    {
        return $this->morphTo();
    }
}
