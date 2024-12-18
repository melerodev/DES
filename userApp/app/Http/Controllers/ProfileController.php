<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        $view = $request->route()->getName() === 'profile.password' ? 'profile.password' : 'profile.edit';
        return view($view, ['user' => auth()->user()]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    /*  Edición de nombre y correo V1 */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        // Check if email is being changed
        if ($validated['email'] !== $user->email) {
            $validated['email_verified_at'] = null; // Reset verification
            $user->update($validated);
            $user->sendEmailVerificationNotification(); // Send new verification email
            return back()->with('status', 'Profile updated successfully. Please verify your new email address.')->widtherrors(['status' => 'Ya no estás verificado.']);
        }

        // Only name is being updated
        $user->update($validated);
        return back()->with('status', 'Profile updated successfully!');
    }
    
    /*  Edición de password V1 */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('status', 'Password changed successfully!');
    }

    /* Borrar el usuario de la BD */
    public function destroy($id)
    {
        // obtener el rol del usuario autenticado
        $user = auth()->user();

        // obtener el rol de un usuario mediante su id
        $role = User::findOrFail($id)->role;

        // si el rol es admin o superadmin y el usuario autenticado no es superadmin, no se puede borrar
        if (($role === 'admin' || $role === 'superadmin') && $user->role !== 'superadmin') {
            return redirect()->route('usermanager')->with('error', 'No tienes permisos para borrar este usuario.');
        }

        // si el rol es superadmin y el usuario autenticado no es superadmin, no se puede borrar
        if ($role === 'superadmin' && $user->role !== 'superadmin') {
            return redirect()->route('usermanager')->with('error', 'No puedes borrar un usuario con rol de superadministrador.');
        }

        if ($user->id === User::findOrFail($id)->id) {
            return redirect()->route('usermanager')->with('error', 'No puedes borrar tu propio usuario.');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('usermanager')->with('success', 'Usuario eliminado correctamente.');
    }
}
