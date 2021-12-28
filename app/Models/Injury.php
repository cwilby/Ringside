<?php

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;
    use Unguarded;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Retrieve the injured model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function injurable()
    {
        return $this->morphTo();
    }
}
