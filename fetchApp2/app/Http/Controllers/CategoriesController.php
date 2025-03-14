<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all()->pluck('name', 'id');
        return response()->json(['categories' => $categories]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category]);
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json(['category' => $category]);
    }
}
