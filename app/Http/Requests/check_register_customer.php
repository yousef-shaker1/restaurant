<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class check_register_customer extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'email' => 'required|min:5|max:50',
            'password' => 'required|min:5|max:50',
            'confirmpassword' => 'required|same:password',
            'phone' => 'required|min:10|max:12',
            'date' => 'required',
            'address' => 'required',
        ];
    }
}
