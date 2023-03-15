<?php

namespace App\Rules;

use App\Models\Competition;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class MaxPlayersAllowedRule implements ValidationRule
{
    /**
     * @param Competition $competition
     */
    public function __construct(
        private readonly Competition $competition
    ) {}

    /**
     * Run the validation rule.
     *
     * @param string                                        $attribute
     * @param mixed                                         $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->competition->players->count() > $this->competition->player_limit) {
            $fail(
                'general',
                sprintf(
                    'The competition %s has reached its maximum numbers of players allowed.',
                    ucfirst($this->competition->name),
                ),
            );
        }
    }
}
