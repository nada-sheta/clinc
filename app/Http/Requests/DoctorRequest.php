<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
     public function rules()
    {
        $doctorId = $this->route('doctor'); // {doctor} من الروت

        return [
            'name'          => 'sometimes|required|string',
            'description'   => 'sometimes|string|nullable',
            'booking_price' => 'sometimes|required|numeric',
            'image'         => 'sometimes|image|nullable',
            'major_id'      => 'sometimes|required|exists:majors,id',
            'email'         => "sometimes|required|email|unique:users,email,{$doctorId}",
            'password'      => 'sometimes|required|string|min:6|nullable',
        ];
    }

}
