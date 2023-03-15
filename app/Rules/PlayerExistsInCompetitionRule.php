<?php

namespace App\Rules;

use App\Models\Competition;
use App\Models\CompetitionPlayer;
use App\Models\Player;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PlayerExistsInCompetitionRule implements ValidationRule
{
    /**
     * @param Competition $competition
     */
    public function __construct(
        private readonly Competition $competition
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param string                                        $attribute
     * @param mixed                                         $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $player = Player::where(Player::COL_NAME, $value)->first();

        if (
            $this->competition
                ->players()
                ->where(CompetitionPlayer::COL_PLAYER_ID, $player->id)
                ->first()
        ) {
            $fail(
                'general',
                sprintf(
                    'The player %s has already joined the competition %s.',
                    ucfirst($value),
                    ucfirst($this->competition->name),
                ),
            );
        }
    }
}
