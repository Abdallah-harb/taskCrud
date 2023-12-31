<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:50",
            "email" => "required|email|unique:users,email,".$this->id,
            "password" => "required |string|min:6",
            "password_confirmation" => "required |string|same:password",
            "mobile" =>  "required|string|unique:users,mobile,".$this->id,
        ];
    }
}
