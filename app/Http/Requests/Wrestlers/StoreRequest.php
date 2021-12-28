<?php

namespace App\Http\Requests\Wrestlers;

use App\Models\Wrestler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Wrestler::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('wrestlers')],
            'feet' => ['required', 'integer'],
            'inches' => ['required', 'integer', 'max:11'],
            'weight' => ['required', 'integer'],
            'hometown' => ['required', 'string'],
            'signature_move' => ['nullable', 'string'],
            'started_at' => ['nullable', 'string', 'date'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'started_at' => 'date started',
            'signature_move' => 'signature move',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator): void {
            if ($validator->errors()->isEmpty()) {
                $this->merge(['height' => ($this->input('feet') * 12) + $this->input('inches')]);
                $this->offsetUnset('feet');
                $this->offsetUnset('inches');
            }
        });
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validated = array_merge(parent::validated(), [
            'height' => $this->input('height'),
        ]);

        unset($validated['feet'], $validated['inches']);

        return $validated;
    }
}
