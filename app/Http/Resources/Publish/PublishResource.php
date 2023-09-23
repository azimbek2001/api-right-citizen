<?php
declare(strict_types=1);

namespace App\Http\Resources\Publish;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Publish;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Publish
 */
class PublishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => CategoryResource::make($this->category),
            'likes' => $this->countSignLikes(),
            'dislikes' => $this->countSignDislikes(),
        ];
    }


}
