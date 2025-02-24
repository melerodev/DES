<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //java: import
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory; //inser a trait

    protected $table = 'pokemon';
    public $timestamps = false;

    protected $fillable = ['name', 'weight', 'height', 'type', 'evolution', 'image'];
}
