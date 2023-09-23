<?php

namespace App\Http\Controllers\Api\V1\Publish;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Publish\CreatePublishRequest;
use App\Http\Requests\Publish\FilterPublishRequest;
use App\Http\Resources\Publish\PublishResource;
use App\Http\Resources\Publish\PublishResourceReview;
use App\Models\Publish;
use App\Models\Reviews;
use App\Models\Sign;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PublishController extends ApiController
{
    public function index(FilterPublishRequest $request): AnonymousResourceCollection
    {
        $publishes = Publish::query()
            ->when($request->category_id, function (Builder $q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->when($request->user_id, function (Builder $q) use ($request) {
                $q->where('user_id', $request->user_id);
            })
            ->when($request->search, function (Builder $q) use ($request) {
                $q->where(function (Builder $query) use ($request) {
                    $query->where('title', 'ILIKE', "%$request->search%")
                        ->orWhere('description', 'ILIKE', "%$request->search%");
                });
            })
            ->with(['signLikes', 'signDislikes'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return PublishResource::collection($publishes);
    }

    public function store(CreatePublishRequest $request): PublishResource
    {
        $publish = Publish::query()->create([
            ...$request->validated(),
            'user_id' => Auth::user()->id,
        ]);

        return PublishResource::make($publish);
    }

    public function show(int $id): PublishResourceReview
    {
        return PublishResourceReview::make(
            Publish::where('id', $id)->first()
        );
    }

    public function sign(int $id, Request $request): JsonResponse
    {
        $sign = Sign::where('publish_id', $id)->where('user_id', Auth::user()->id)->first();

        if ($sign) {
            return $this->jsonResponse([], 'Вы уже подписывали закон', 422);
        }

        $sign = Sign::query()->create([
            'user_id' => Auth::user()->id,
            'publish_id' => $id,
            'is_like' => $request->is_like,
        ]);

        if ($request->comment) {
            $review = Reviews::query()->create([
                'comment' => $request->comment,
                'publish_id' => $id,
                'sign_id' => $sign->id,
            ]);
        }

        return $this->jsonResponse(['sign' => $sign, 'review' => $review ?? null]);
    }
}
