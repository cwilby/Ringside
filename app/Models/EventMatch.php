<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMatch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['event_id', 'event_match_id', 'match_type_id', 'preview'];

    /**
     * Get the referees assigned to the match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function referees()
    {
        return $this->belongsToMany(Referee::class);
    }

    /**
     * Get the titles being competed for in the match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function titles()
    {
        return $this->belongsToMany(Title::class);
    }

    /**
     * Get the competitors of the match.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function competitors()
    {
        return $this->morphToMany(EventMatchCompetitor::class, 'event_match_competitor');
    }
}
