<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function login(Request $request) {
        $request->session()->flash('message', 'Un usuario se ha logeado');
        $request->session()->put('user', true);
        return back();
    }

    function logout(Request $request) {
        $request->session()->flash('message', 'Un usuario ha salido');
        $request->session()->forget('user');
        return back();
    }

    function main() {
        return view('main.main', ['lihome' => 'active']);
    }
}
