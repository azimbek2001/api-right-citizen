<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'publish_id', 'comment','sign_id'
    ];

    public function sign(){
        return $this->belongsTo(Sign::class);
    }
}
