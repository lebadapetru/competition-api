<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompetitionPlayer extends Pivot
{
    use HasFactory;

    const COL_COMPETITION_ID = 'competition_id';
    const COL_PLAYER_ID      = 'player_id';
    const COL_SCORE          = 'score';

    protected $fillable = [
        self::COL_SCORE,
    ];

    public $incrementing = true;
}
