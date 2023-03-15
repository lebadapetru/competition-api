<?php

namespace App\Http\Requests;

use App\Http\Controllers\CompetitionController;
use App\Rules\MaxPlayersAllowedRule;
use App\Rules\PlayerExistsInCompetitionRule;
use Illuminate\Foundation\Http\FormRequest;

class AddPlayerToCompetitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            //i would use player's id rather than its name
            CompetitionController::PARAM_NAME => [
                'required',
                'max:255',
                'bail',
                'exists:players',
                new PlayerExistsInCompetitionRule($this->competition),
                new MaxPlayersAllowedRule($this->competition),
            ],
        ];
    }
}
