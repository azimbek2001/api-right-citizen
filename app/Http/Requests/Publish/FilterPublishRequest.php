<?php
declare(strict_types=1);

namespace App\Http\Requests\Publish;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FilterPublishRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|numeric',
            'user_id' => 'nullable|numeric',
            'sort_reputation' => 'nullable|numeric', //1 or 0
            'sort_created_date' => 'nullable|numeric',
            'search' => 'nullable|string',
        ];
    }
}
