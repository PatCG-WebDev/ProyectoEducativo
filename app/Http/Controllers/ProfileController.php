<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    /////////////  ADMINISTRATOR  /////////////////////////////////////////

    //Muestra la lista de perfiles
    public function showProfiles(Request $request)
    {
        $orderBy = $request->input('order_by', 'id');
        $orderDirection = $request->input('order_direction', 'asc');

        // Si se desea ordenar de forma descendente, cambiar la dirección del ordenamiento
        if ($orderDirection === 'desc') {
            $orderDirection = 'desc';
        } else {
            $orderDirection = 'asc';
        }

        // Ordenar los perfiles según el parámetro 'order_by' y 'order_direction'
        $profiles = Profile::orderBy($orderBy, $orderDirection)->get();
        
        return view('administrator.profile.admin_show_profiles', compact('profiles'));
    }
    //Formulario para añadir nuevo perfil
    public function addProfileForm()
    {
        return view('administrator.profile.admin_add_profile');
    }

    // Añade un nuevo perfil
    public function addProfile(Request $request)
    {
        $this->validateProfile($request);

        $profile = new Profile();
        $profile->name = $request->name;
        $profile->save();

        return redirect()->route('administrator.show_profiles')->with('success', 'Perfil agregado correctamente.');
    }

    //Formulario para editar un perfil
    public function showEditProfileForm($profileId)
    {
        $profile = Profile::find($profileId);

        if (!$profile) {
            return redirect()->route('home')->with('error', 'Perfil no encontrado.');
        }

        return view('administrator.profile.admin_edit_profile', compact('profile'));
    }


    //Actualiza un perfil
    public function updateProfile(Request $request)
    {
        $this->validateProfile($request, $request->profile_id);

        $profile = Profile::findOrFail($request->profile_id);
        $profile->name = $request->name;
        $profile->save();

        return redirect()->route('administrator.show_profiles')->with('success', 'Perfil actualizado correctamente.');
    }

    
    //Elimina un perfil
    public function deleteProfile($profileId)
    {
        $profile = Profile::find($profileId);

        if (!$profile) {
            return redirect()->route('administrator.show_profiles')->with('error', 'Perfil no encontrado.');
        }

        $profile->delete();

        return redirect()->route('administrator.show_profiles')->with('success', 'Perfil eliminado correctamente.');
    }


    //Valida datos del perfil
    private function validateProfile(Request $request, $profileId = null)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:profiles,name' . ($profileId ? ',' . $profileId : ''),
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'El nombre del perfil ya está en uso.',
        ];

        $request->validate($rules, $messages);
    }


    ////////   PERFIL USUARIO  /////////////////////////////////////////////
    public function updateProfileInformation(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            // Eliminar la foto de perfil del almacenamiento
            // Ejemplo: Storage::delete($user->profile_photo_path);

            // Actualizar la ruta de la foto de perfil del usuario en la base de datos
            $user->update(['profile_photo_path' => null]);
        }

        return back()->with('success', 'Foto de perfil eliminada correctamente.');
    }

    public function sendEmailVerification()
    {
        $user = Auth::user();

        if ($user && ! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            return back()->with('verificationLinkSent', true);
        }

        return back()->with('error', 'No se pudo enviar el enlace de verificación.');
    }
}