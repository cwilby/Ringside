<?php

namespace App\Models;

use App\Builders\TitleQueryBuilder;
use App\Enums\TitleStatus;
use App\Models\Contracts\Activatable;
use App\Models\Contracts\Deactivatable;
use App\Models\Contracts\Retirable;
use App\Observers\TitleObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model implements Activatable, Deactivatable, Retirable
{
    use Concerns\Activatable,
        Concerns\Competable,
        Concerns\Deactivatable,
        Concerns\Retirable,
        Concerns\Unguarded,
        HasFactory,
        SoftDeletes;

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(TitleObserver::class);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new TitleQueryBuilder($query);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => TitleStatus::class,
    ];

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function championships()
    {
        return $this->hasMany(TitleChampionship::class)->oldest('won_at');
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentChampion()
    {
        return $this->morphOneThrough(TitleChampionship::class, 'champion')->whereNotNull('lost_at');
    }

    /**
     * Determine if the model can be retired.
     *
     * @return bool
     */
    public function canBeRetired()
    {
        if ($this->isCurrentlyActivated()) {
            return true;
        }

        if ($this->isDeactivated()) {
            return true;
        }

        return false;
    }
}
