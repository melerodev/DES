<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Sale;

class HomeController extends BaseController 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']); 
        $this->middleware('verified')->only(['verify']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('index', compact('sales'));
    }

    public function crearProducto()
    {
        return view('createnewproduct');
    }
    public function edit($id)
    {
        $sale = Sale::find($id);
        $categories = Category::all();
        return view('editproduct', compact('sale', 'categories'));
    }

    public function index()
    {
        $sales = Sale::where('issold', '')->get();
        $images = null;
        foreach($sales as $sale) {
            $images = Image::where('sale_id', $sale->id)->get();
        }
        return view('index', compact('sales', 'images'));
    }

    function verificado() {
        return view('verificado');
    }

    function userManager() {
        $users = User::all();
        return view('usermanager', ['users' => $users]);
    }
}
