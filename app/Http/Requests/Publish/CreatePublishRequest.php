<?php
declare(strict_types=1);

namespace App\Http\Requests\Publish;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePublishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|numeric',
            'title' => 'required|array',
            'title.ru' => 'required|string|max:250', //1 or 0
            'title.ky' => 'required|string|max:250', //1 or 0
            'description' => 'required|array',
            'description.ru' => 'required|string',
            'description.ky' => 'required|string',
        ];
    }
}
