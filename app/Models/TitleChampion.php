<?php

namespace App\Models;

use App\Models\Concerns\Unguarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TitleChampion extends Model
{
    use HasFactory,
        Unguarded;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'title_champions';
}
