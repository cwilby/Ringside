<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 */
class Venue extends Model
{
    use Concerns\Unguarded,
        HasFactory,
        SoftDeletes;
}
