<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorApplicationRequest extends FormRequest
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
        'name'               => ['required', 'string', 'min:3', 'max:255'],
        'phone'              => ['required', 'string', 'min:10', 'max:15'],
        'email'              => ['required', 'email', 'max:255'],
        'major'              => ['required', 'string', 'min:3', 'max:255'],
        'session_price'      => ['nullable','required', 'numeric', 'min:0'],
        'degree_certificate' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'], // 2MB max
        ];
    }
}
