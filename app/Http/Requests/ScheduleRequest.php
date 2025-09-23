<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'day_from'   => 'required|string',
            'day_to'     => 'required|string',
            'time_from'  => 'required|date_format:H:i',
            'time_to'    => 'required|date_format:H:i|after:time_from',
            'start_date' => 'required|date|after_or_equal:today',
        ];
    }
}
