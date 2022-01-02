<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_match_id', 'competitor_id', 'competitor_type'];
}
