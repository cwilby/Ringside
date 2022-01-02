<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

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
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['injurable_id', 'injurable_type', 'started_at', 'ended_at'];

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
