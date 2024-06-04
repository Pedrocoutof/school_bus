<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'city' => 'required',
            'zip_code' => 'required',
            'public_place' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'state' => 'required',
        ];
    }

    public function messages(): array {
        return [
            'email.unique' => "Email já cadastrado."
        ];
    }
}
