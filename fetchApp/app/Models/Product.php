<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['name', 'price'];

    function store() {
        try {
            $result = $this->save();
            // $products = Product::orderBy('name')->paginate(10)->setPath(url('product'));
        } catch(\Exception $e) {
            $result = false;
            // $message = $e->getMessage();

        }
    }
}

