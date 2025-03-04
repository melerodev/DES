<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Obtén al usuario autenticado
        $user = Auth::user();
        return view('user.index', compact('user'));
    }

    public function update(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(), // Excluye el email actual
            'current_password' => 'required|string', // Contraseña actual requerida
            'password' => 'nullable|string|min:8|confirmed', // Opcional, pero si se llena debe ser válido
        ]);

        // Verifica la contraseña actual
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Verifica que la nueva contraseña no sea igual a la actual
        if (!empty($request->password) && Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'La nueva contraseña nueva no puede ser igual a la actual.']);
        }

        // Actualiza los datos del usuario
        $user = Auth::user();

        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Información actualizada correctamente.');
    }
}
