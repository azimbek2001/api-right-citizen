<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Publish;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Publish\CreatePublishRequest;
use App\Http\Requests\Publish\FilterPublishRequest;
use App\Http\Resources\Publish\PublishResource;
use App\Models\Publish;
use Illuminate\Support\Facades\Auth;

class PublishController extends ApiController
{
    public function index(FilterPublishRequest $request)
    {
        $publishes = Publish::query()
            ->when()
            ->when()
            ->when()
            ->paginate(20);

        return PublishResource::collection($publishes);
    }

    public function store(CreatePublishRequest $request): PublishResource
    {
        $publish = Publish::query()->create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);

        return PublishResource::make($publish);
    }
}
