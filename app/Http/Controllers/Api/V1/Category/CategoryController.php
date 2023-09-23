<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends ApiController
{
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }
}
