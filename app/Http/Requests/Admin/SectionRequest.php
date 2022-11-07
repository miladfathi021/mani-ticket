<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sections' => 'bail|required|array',
            'sections.*' => 'bail|required|array',
            'sections.*.name' => 'bail|required|string|max:255',
            'sections.*.description' => 'sometimes|string',
            'sections.*.hall_id' => 'bail|required|integer|exists:halls,id',
            'sections.*.row_count' => 'bail|required|integer',
            'sections.*.column_count' => 'bail|required|integer',
            'sections.*.row_number_from' => 'bail|required|integer',
            'sections.*.column_number_from' => 'bail|required|integer'
        ];
    }
}
