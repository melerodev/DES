<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model {
    use HasFactory;

    protected $fillable = ['title', 'artist', 'category_id', 'route_image', 'route_song'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
