<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
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
}
