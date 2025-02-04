<?php

namespace App\Http\Controllers;

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
        //$this->middleware('auth');  //Excepción de autenticación para el método home se aplica a todos los métodos
        $this->middleware('auth')->except(['index']);  //Excepción de autenticación para el método index se aplica a todos los métodos excepto el introducido
        //$this->middleware('auth')->only();  //Excepción de autenticación para el método index solo se aplica al método introducido
        $this->middleware('verified')->only(['verify']);  //Excepción de verificación de correo para el método verify solo se aplica al método introducido
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $sales = Sale::where('issold', '')->get();
        return view('index', compact('sales'));
    }

    public function crearProducto()
    {
        return view('createnewproduct');
    }

    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('editproduct', ['sale' => $sale]);
    }

    function index() {
        $sales = Sale::where('issold', '')->get();
        return view('index', compact('sales'));
    }

    function verificado() {
        return view('verificado');
    }

    function userManager() {
        $users = User::all();
        return view('usermanager', ['users' => $users]);
    }
}
