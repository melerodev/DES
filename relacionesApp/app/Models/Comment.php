<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['mail', 'nickname' , 'post_id' ,  'text'];

    protected $table = 'comments';

    public function post() :BelongsTo {
        return $this->belongsTo(Post::class);
    }

    public function isEditable($plusMinutes = 0) :bool {
        return $this->created_at->diffInMinutes(Carbon::now()) <= 100 + $plusMinutes;
    }
}
