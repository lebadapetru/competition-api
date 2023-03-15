<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Player
 *
 * @package App\Models\Player
 *
 * @property int                 $id
 * @property string              $name
 *
 * @property Collection|Player[] $competitions
 */
class Player extends Model
{
    use HasFactory;

    const COL_NAME = 'name';

    protected $fillable = [
        self::COL_NAME,
    ];

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class)
                    ->using(CompetitionPlayer::class)
                    ->withPivot([
                        CompetitionPlayer::COL_SCORE,
                        self::CREATED_AT,
                        self::UPDATED_AT,
                    ]);
    }
}
