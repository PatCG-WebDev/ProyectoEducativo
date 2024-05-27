<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Muestra la lista de usuarios
    public function showUsers(Request $request)
    {
        $orderBy = $request->input('order_by', 'users.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $validOrderFields = ['users.id', 'users.name', 'users.email', 'profiles.name'];
        if (!in_array($orderBy, $validOrderFields)) {
            $orderBy = 'users.id';
        }

        $query = User::with('profile');

        if ($orderBy === 'profiles.name') {
            $query->join('profiles', 'users.profile_id', '=', 'profiles.id')
                ->orderBy('profiles.name', $orderDirection)
                ->select('users.*', 'profiles.name AS profile_name');
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $users = $query->paginate(10); // Paginación, 10 resultados por página

        return view('administrator.user.admin_show_users', compact('users', 'orderBy', 'orderDirection'));
    }

    // Formulario para añadir un nuevo usuario
    public function addUserForm()
    {
        $profiles = Profile::all();
        return view('administrator.user.admin_add_user', compact('profiles'));
    }

    // Añade un nuevo usuario
    public function addUser(Request $request)
    {
        $this->validateUser($request);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile_id = $request->profile_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('administrator.show_users')->with('success', 'Usuario agregado correctamente.');
    }

    // Formulario para editar un usuario
    public function showEditUsersForm($userId)
    {
        $user = User::findOrFail($userId);
        $profiles = Profile::all();

        return view('administrator.user.admin_edit_user', compact('user', 'profiles'));
    }

    // Actualiza un usuario
    public function updateUsers(Request $request)
    {
        $this->validateUser($request, $request->user_id);

        $user = User::findOrFail($request->user_id);
        $userData = $request->only(['name', 'email', 'profile_id']);

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $user->update($userData);

        return redirect()->route('administrator.show_users')->with('success', 'Usuario actualizado correctamente.');
    }

    // Elimina un usuario
    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('administrator.show_users')->with('success', 'Usuario eliminado correctamente.');
    }

    // Valida los datos del usuario
    private function validateUser(Request $request, $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($userId ? ',' . $userId : ''),
            'profile_id' => 'required|exists:profiles,id',
            'password' => ($userId ? 'nullable' : 'required') . '|string|min:8',
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'profile_id.required' => 'El perfil es obligatorio.',
            'profile_id.exists' => 'El perfil seleccionado no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];

        $request->validate($rules, $messages);
    }
}
