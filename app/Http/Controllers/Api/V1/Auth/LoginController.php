<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\Login\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LoginController extends ApiController
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $token = User::login($request->pin, $request->password);
        } catch (\Exception $e) {
            return $this->jsonResponse([], $e->getMessage(), $e->getCode());
        }

        return $this->jsonResponse([
            'token' => $token,
        ]);
    }
}
