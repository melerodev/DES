<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = ['title', 'entry' , 'text'];

    protected $table = 'posts';

    public function comments() :HasMany {
        return $this->HasMany(Comment::class);
    }
}
