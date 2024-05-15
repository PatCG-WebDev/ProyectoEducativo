<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    ///////////////  ADMINISTRATOR  //////////////////////////////////////
    public function showUsers(Request $request)
    {
        $orderBy = $request->input('order_by', 'users.id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($orderBy === 'name') {

            $users = User::orderBy('name', $orderDirection)->get();

        }elseif($orderBy === 'profile.name') {

            $users = User::join('profiles', 'users.profile_id', '=', 'profiles.id')
            ->select('users.*', 'profiles.name AS profile->name')
            ->orderBy('profiles.name', $orderDirection)
            ->get();
        }elseif($orderBy === 'email'){

            $users = User::orderBy('email', $orderDirection)->get();

        }else{
            $users = User::orderBy('id', $orderDirection)->get(); 
        }
        
        return view('administrator.user.admin_show_users', compact('users', 'orderBy'));
    }

    public function showEditUsersForm($userId)
    {
        $user = User::find($userId);
        $profiles = Profile::all();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuario no encontrado.');
        }

        return view('administrator.user.admin_edit_user', compact('user', 'profiles'));
    }

    public function updateUsers(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'profile_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
        ]);

        $user = User::findOrFail($request->user_id);

        $user->profile_id = $request->profile_id;
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('administrator.show_users')->with('success', 'Usuario actualizado correctamente.');
    }

    public function addUserForm()
    {
        $profiles = Profile::all();
        return view('administrator.user.admin_add_user', compact('profiles'));
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'profile_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'profile_id' => $request->profile_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrator.show_users')->with('success', 'Usuario agregado correctamente.');
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('administrator.show_users')->with('error', 'Usuario no encontrado.');
        }

        $user->delete();

        return redirect()->route('administrator.show_users')->with('success', 'Usuario eliminado correctamente.');
    }

    public function showReports()
    {
        $users = User::all();
        return view('seeReports', compact('users'));
    }
}
