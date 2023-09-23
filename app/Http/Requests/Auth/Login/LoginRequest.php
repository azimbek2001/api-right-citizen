<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pin' => 'required|string|min:14|max:14',
            'password' => 'required|string|max:15',
        ];
    }
}
