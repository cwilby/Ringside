<?php

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleChampionship extends Model
{
    use HasFactory,
        Unguarded;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'title_championships';

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function champion()
    {
        return $this->morphTo();
    }

    /**
     * Undocumented function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function previousChampion()
    {
        return $this->whereNotNull('lost_at')->sortByDesc('won_at')->morphTo();
    }
}
