<?php

namespace App\Http\Requests;

use App\Models\Display;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DisplayUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        $display = $this->route('display');

        return $this->user()->can('update', $display);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price_per_day' => 'sometimes|required|numeric',
            'resolution_height' => 'sometimes|required|integer',
            'resolution_width' => 'sometimes|required|integer',
            'type' => 'sometimes|required|in:indoor,outdoor',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->hasAny(['name', 'description', 'price_per_day', 'resolution_height', 'resolution_width', 'type'])) {
                $validator->errors()->add('field', 'At least one field must be provided.');
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.sometimes' => 'The name is required when provided.',
            'name.required' => 'Please provide a name for the display.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be longer than 255 characters.',

            'description.sometimes' => 'The description is required when provided.',
            'description.required' => 'Please provide a description for the display.',
            'description.string' => 'The description must be a valid string.',

            'price_per_day.sometimes' => 'The price per day is required when provided.',
            'price_per_day.required' => 'Please provide a price per day.',
            'price_per_day.numeric' => 'The price per day must be a numeric value.',

            'resolution_height.sometimes' => 'The resolution height is required when provided.',
            'resolution_height.required' => 'Please provide a resolution height.',
            'resolution_height.integer' => 'The resolution height must be an integer.',

            'resolution_width.sometimes' => 'The resolution width is required when provided.',
            'resolution_width.required' => 'Please provide a resolution width.',
            'resolution_width.integer' => 'The resolution width must be an integer.',

            'type.sometimes' => 'The type is required when provided.',
            'type.required' => 'Please specify the type of display.',
            'type.in' => 'The specified type is invalid. Valid types are "indoor" or "outdoor".',
        ];
    }
}
