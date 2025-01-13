<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; // Esta tabla no tiene timestamps

    protected $fillable = ['name'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
