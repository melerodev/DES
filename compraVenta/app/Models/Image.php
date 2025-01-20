<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'sale_id', 
        'route'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
