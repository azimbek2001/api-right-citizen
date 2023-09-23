<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publish extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function setDescriptionAttribute(array $description): void
    {
        $this->attributes['description'] = json_encode($description);
    }

    public function setTitleAttribute(array $title): void
    {
        $this->attributes['title'] = json_encode($title);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
