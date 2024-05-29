<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    // Muestra usuarios
    public function showUsers(Request $request)
    {
        $query = User::with('profile'); //obtener users y su relación con profiles

        //Obtiene los parámetros de ordenación de la solicitud HTTP, si no los tiene utiliza los siguientes parámetros predeterminados:
        $orderBy = $request->input('order_by', 'users.id'); //campo predeterminado id
        $orderDirection = $request->input('order_direction', 'asc'); //dirección predeterminada asc.
    
        
        $validOrderFields = ['users.id', 'users.name', 'users.email', 'profiles.name']; //Definir los campos por los que se puede ordenar.
        $orderBy = in_array($orderBy, $validOrderFields) ? $orderBy : 'users.id'; //Definir si el campo de ordenamiento es válido, si no lo es ordenar por id
    
        if ($orderBy === 'profiles.name') { //Cuando el campo de ordenación es profiles, hacemos la unión entre las 2 tablas.
            $query->join('profiles', 'users.profile_id', '=', 'profiles.id')
                ->orderBy('profiles.name', $orderDirection)
                ->select('users.*', 'profiles.name AS profile_name');
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }
    
        $users = $query->paginate(10);
    
        return view('administrator.user.admin_show_users', compact('users', 'orderBy', 'orderDirection'));
    }
    

    // Formulario añadir usuario
    public function addUserForm()
    {
        $profiles = Profile::all();
        return view('administrator.user.admin_add_user', compact('profiles'));
    }

    // Añade usuario
    public function addUser(Request $request)
    {
        $this->validateUser($request);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile_id = $request->profile_id;
        $user->password = Hash::make($request->password);
        $user->save();

        // Obtener posición del NUEVO usuario en la lista ordenada por ID ascendente
        $userPosition = User::where('id', '<=', $user->id)->count();

        // Calcular la página en la que se encuentra el nuevo usuario
        $itemsPerPage = 10; 
        $userPage = ceil($userPosition / $itemsPerPage);

        return Redirect::route('administrator.show_users', ['page' => $userPage])->with('success', 'Asignatura agregada correctamente.');
    }

    // Formulario editar usuario
    public function showEditUsersForm($userId)
    {
        $user = User::findOrFail($userId);
        $profiles = Profile::all();

        return view('administrator.user.admin_edit_user', compact('user', 'profiles'));
    }

    // Actualiza usuario
    public function updateUsers(Request $request)
    {
        $this->validateUser($request, $request->user_id);

        $user = User::findOrFail($request->user_id);
        $userData = $request->only(['name', 'email', 'profile_id']);

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $user->update($userData);

        // Obtener posición del usuario actualizado en la lista ordenada por ID ascendente
        $userPosition = User::where('id', '<=', $user->id)->count();

        // Calcular página en la que se encuentra el usuario actualizado
        $itemsPerPage = 10; 
        $userPage = ceil($userPosition / $itemsPerPage);

        // Redirigir al usuario a la página de la paginación donde se encuentra el usuario actualizado
        return redirect()->route('administrator.show_users', ['page' => $userPage])->with('success', 'Usuario actualizado correctamente.');
    }

    // Elimina usuario
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
