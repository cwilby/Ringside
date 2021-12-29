<?php

namespace App\Models;

use App\Builders\WrestlerQueryBuilder;
use App\Casts\HeightCast;
use App\Enums\WrestlerStatus;
use App\Models\Concerns\CanJoinStables;
use App\Models\Concerns\CanJoinTagTeams;
use App\Models\Concerns\HasManagers;
use App\Models\Concerns\OwnedByUser;
use App\Models\Concerns\Unguarded;
use App\Models\Contracts\Bookable;
use App\Models\Contracts\CanBeAStableMember;
use App\Models\Contracts\Manageable;
use App\Models\Contracts\TagTeamMember;
use App\Observers\WrestlerObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wrestler extends SingleRosterMember implements Bookable, CanBeAStableMember, Manageable, TagTeamMember
{
    use CanJoinStables;
    use CanJoinTagTeams;
    use HasFactory;
    use HasManagers;
    use OwnedByUser;
    use SoftDeletes;
    use Unguarded;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => WrestlerStatus::class,
        'height' => HeightCast::class,
    ];

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        self::observe(WrestlerObserver::class);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new WrestlerQueryBuilder($query);
    }
}
