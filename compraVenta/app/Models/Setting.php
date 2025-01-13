<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false; // Esta tabla no tiene timestamps

    protected $fillable = [
        'name', 
        'maxfiles'
    ];
}
