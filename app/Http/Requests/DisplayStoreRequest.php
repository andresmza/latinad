<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisplayStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price_per_day' => 'required|numeric|min:0',
            'resolution_height' => 'required|integer|min:1',
            'resolution_width' => 'required|integer|min:1',
            'type' => 'required|in:indoor,outdoor',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'The name of the display is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a valid string.',
            'description.max' => 'The description may not be longer than 1000 characters.',

            'price_per_day.required' => 'The price per day is required.',
            'price_per_day.numeric' => 'The price per day must be a numeric value.',
            'price_per_day.min' => 'The price per day cannot be negative.',
            
            'resolution_height.required' => 'The resolution height is required.',
            'resolution_height.integer' => 'The resolution height must be an integer.',
            'resolution_height.min' => 'The resolution height must be at least 1.',
            
            'resolution_width.required' => 'The resolution width is required.',
            'resolution_width.integer' => 'The resolution width must be an integer.',
            'resolution_width.min' => 'The resolution width must be at least 1.',
            
            'type.required' => 'The type of the display is required.',
            'type.in' => 'The specified type is invalid. Valid types are "indoor" or "outdoor".'
        ];
    }
}
