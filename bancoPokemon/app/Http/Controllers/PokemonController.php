<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{

    function index() {
        return view('bank.index', ['lipokemon' => 'active',
                                        'pokemons' => Pokemon::orderBy('name')->get(),]);
    }

    function create() {
        return view('bank.create', ['lipokemon' => 'active']);
    }

    function destroy(Pokemon $pokemon) {
        try {
            $pokemon->delete();
            return redirect('pokemon')->with(['message' => 'El pokemon ha sido eliminado.']);
        } catch(\Exception $e) {
            return back()->withErrors(['message' => 'El pokemon no ha sido eliminado.']);
        }
    }

    function edit(Pokemon $pokemon) {
        return view('bank.edit', ['lipokemon' => 'active',
                                        'pokemon' => $pokemon,]);
    }

    function show(Pokemon $pokemon) {
        return view('bank.show', ['lipokemon' => 'active',
                                        'pokemon' => $pokemon,]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'name'  => 'required|unique:pokemon|max:20|min:2',
            'weight' => 'required|numeric|gte:0|lte:100000',
            'height' => 'required|numeric|gte:0|lte:100000',
            'type' => 'required|max:20|min:2',
            'evolution' => 'required|numeric|gte:0|lte:5',
        ]);
        $object = new Pokemon($request->all());
        try {
            //$result = $object->save();
            $object = Pokemon::create($request->all());
            return redirect('pokemon')->with(['message' => 'El Pokémon ha sido creado.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El Pokémon no ha sido creado.']);
        }
    }

    function update(Request $request, Pokemon $pokemon) {
        $validated = $request->validate([
            'name'  => 'required|max:20|min:2|unique:pokemon,name,' . $pokemon->id,
            'weight' => 'required|numeric|gte:0|lte:100000',
            'height' => 'required|numeric|gte:0|lte:100000',
            'type' => 'required|max:20|min:2',
            'evolution' => 'required|numeric|gte:0|lte:5',
        ]);
        try {
            $result = $pokemon->update($request->all());
            return redirect('pokemon')->with(['message' => 'El Pokémon ha sido actualizado.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El Pokémon NO ha sido actualizado.']);
        }
    }
    
}
