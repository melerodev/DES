<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // rrsp - registros por página
        $rpps = [10, 20, 50, 100];
        $orderBy = 'marca';
        $orderType = 'asc';
        $rpp = 10;
        $q = '';
        $coches = Coche::paginate(10);
        return view('coche.index', compact('rpps', 'orderBy', 'orderType', 'rpp', 'q', 'coches'));
    }
}
