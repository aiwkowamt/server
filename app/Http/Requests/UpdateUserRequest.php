<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|min:5|max:50',
            'address' => 'required|string|min:5|max:255',
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'phone' => 'required|string|min:10|max:20',
            'role_id' => 'required|integer|between:1,4',
        ];
    }
}
