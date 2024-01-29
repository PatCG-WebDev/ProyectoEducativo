<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\Subject;

class NoteController extends Controller
{
    public function showNotesBySubject($subjectId)
    {
        // Obtener el usuario logueado
        $user = Auth::user();

        // Obtener la asignatura específica
        $subject = Subject::find($subjectId);

        // Verificar si la asignatura existe y pertenece al usuario
        if ($subject && $user->subjects->contains($subject)) {
            // Obtener las notas para la asignatura y el usuario
            $notes = Note::where('user_id', $user->id)
                ->where('subject_id', $subject->id)
                ->get();

            // Retornar la vista con las notas
            return view('showNotesBySubject', compact('subject','notes'));
        }

        // Si la asignatura no existe o no pertenece al usuario, puedes redirigir o manejar el error de alguna otra manera.
        return redirect()->route('home')->with('error', 'Asignatura no encontrada o no autorizada.');
    }
}

