<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function getMe(): UserResource
    {
        return UserResource::make(Auth::user());
    }

    public function show(int $id): UserResource
    {
        return UserResource::make(User::where('id',$id)->first());
    }
}
