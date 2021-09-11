<?php

namespace App\Models;

use App\Enums\TitleStatus;
use App\Models\Contracts\Activatable;
use App\Models\Contracts\Deactivatable;
use App\Models\Contracts\Retirable;
use App\Models\TitleChampion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

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
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($title) {
            $title->updateStatus();
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'titles';

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
        return $this->hasMany(TitleChampionship::class);
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function champion()
    {
        return $this->hasOne(TitleChampionship::class)->latestOfMany('won_at')->whereNull('lost_at');
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

    /**
     * Update the status for the title.
     *
     * @return $this
     */
    public function updateStatus()
    {
        $this->status = match (true) {
            $this->isCurrentlyActivated() => TitleStatus::ACTIVE,
            $this->hasFutureActivation() => TitleStatus::FUTURE_ACTIVATION,
            $this->isDeactivated() => TitleStatus::INACTIVE,
            $this->isRetired() => TitleStatus::RETIRED,
            default => TitleStatus::UNACTIVATED
        };

        return $this;
    }
}
