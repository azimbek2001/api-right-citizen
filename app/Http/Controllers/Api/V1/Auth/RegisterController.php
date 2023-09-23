<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\Register\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class RegisterController extends ApiController
{
    public function __invoke(RegisterRequest $request): UserResource
    {
        $user = User::query()->create($request->validated());

        return UserResource::make($user);
    }
}
