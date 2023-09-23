<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pin' => 'required|string|min:14|max:14|unique:users,pin',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|max:15',
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'middle_name' => 'nullable|string|min:2',

        ];
    }
}
