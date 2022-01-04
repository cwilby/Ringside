<?php

namespace App\Http\Requests\EventMatches;

use App\Models\EventMatch;
use App\Rules\CompetitorsAreValid;
use App\Rules\CompetitorsGroupedIntoCorrectNumberOfSidesForMatchType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', EventMatch::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'match_type_id' => ['required', 'integer', Rule::exists('match_types', 'id')],
            'referees' => ['required', 'array'],
            'referees.*' => ['integer', 'distinct', Rule::exists('referees', 'id')],
            'titles' => ['nullable', 'array'],
            'titles.*' => ['integer', 'distinct', Rule::exists('titles', 'id')],
            'competitors' => ['required', 'array', 'min:2'],
            'competitors.*' => ['required', 'array'],
            'competitors.*.competitor_id' => ['required', 'integer', 'distinct', Rule::exists('wrestlers', 'id')],
            'competitors.*.competitor_type' => ['required', Rule::in(['wrestler', 'tag_team'])],
            'preview' => ['nullable', 'string'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($validator->errors()->isEmpty()) {
                $rule = new CompetitorsGroupedIntoCorrectNumberOfSidesForMatchType($this->input('match_type_id'));

                if (! $rule->passes('competitors', $this->input('competitors'))) {
                    $validator->addFailure(
                        'competitors',
                        CompetitorsGroupedIntoCorrectNumberOfSidesForMatchType::class
                    );
                }

                $rule2 = new CompetitorsAreValid;

                if (! $rule2->passes('competitors', $this->input('competitors'))) {
                    $validator->addFailure(
                        'competitors',
                        CompetitorsAreValid::class
                    );
                }
            }
        });
    }
}
