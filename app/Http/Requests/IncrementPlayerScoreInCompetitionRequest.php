<?php

namespace App\Http\Requests;

use App\Http\Controllers\CompetitionController;
use Illuminate\Foundation\Http\FormRequest;

class IncrementPlayerScoreInCompetitionRequest extends FormRequest
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
            CompetitionController::PARAM_SCORE => [
                'required',
                'integer',
                'max:100',
            ]
        ];
    }
}
