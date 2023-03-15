<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Competition
 *
 * @package App\Models\Competition
 *
 * @property int                 $id
 * @property string              $name
 * @property int                 $player_limit
 *
 * @property Collection|Player[] $players
 */
class Competition extends Model
{
    use HasFactory;

    const COL_NAME         = 'name';
    const COL_PLAYER_LIMIT = 'player_limit';

    protected $fillable = [
        self::COL_NAME,
        self::COL_PLAYER_LIMIT,
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
                    ->using(CompetitionPlayer::class)
                    ->withPivot([
                        CompetitionPlayer::COL_SCORE,
                        self::CREATED_AT,
                        self::UPDATED_AT,
                    ]);
    }
}
