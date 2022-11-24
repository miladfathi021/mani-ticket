<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'bail|string|required',
            'description' => 'bail|string|nullable',
            'complex_id' => 'bail|required|exists:complexes,id',
            'artist_id' => 'bail|required|exists:artists,id',
            'date_start' => 'bail|required|date',
            'time_start' => 'bail|required|date_format:H:i',
            'date_end' => 'bail|required|date|after_or_equal:date_start',
            'time_end' => 'bail|required|date_format:H:i',
        ];
    }
}
