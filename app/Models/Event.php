<?php

namespace App\Models;

use App\Builders\EventQueryBuilder;
use App\Models\Concerns\Unguarded;
use App\Observers\EventObserver;
use App\Presenters\EventPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $date
 * @property integer|null $venue_id
 * @property string|null $preview
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Unguarded;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        self::observe(EventObserver::class);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new EventQueryBuilder($query);
    }

    /**
     * Present the event model.
     *
     * @return App\Presenters\EventPresenter
     */
    public function present()
    {
        return new EventPresenter($this);
    }

    /**
     * Retrieve the venue of the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Retrieve the matches for the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany(EventMatch::class);
    }

    /**
     * Checks to see if the event is scheduled for a future date.
     *
     * @return bool
     */
    public function isScheduled()
    {
        return $this->date?->isFuture() ?? false;
    }

    /**
     * Checks to see if the event has already taken place.
     *
     * @return bool
     */
    public function isPast()
    {
        return $this->date?->isPast() ?? false;
    }

    /**
     * Checks to see if the event is unscheduled.
     *
     * @return bool
     */
    public function isUnscheduled()
    {
        return $this->date === null;
    }
}
