<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    /////////////  ADMINISTRATOR  /////////////////////////////////////////

    public function adminProfiles()
    {
        $profiles = Profile::all();
        return view('administrator.adminProfiles', compact('profiles'));
    }



    ////////   PERFIL Ususario  /////////////////////////////////////////////
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