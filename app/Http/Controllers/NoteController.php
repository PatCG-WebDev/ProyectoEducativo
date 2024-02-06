<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;


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

   /*  public function saveNote(Request $request, $userId)
    {
        $request->validate([
            'exam' => 'required',
            'value' => 'required|numeric',
            'comment' => 'required',
        ]);

        $user = User::findOrFail($userId);

        // Asociar la nueva nota al usuario y al curso
        $user->courses()->attach($request->input('course_id'), [
            'exam' => $request->input('exam'),
            'value' => $request->input('value'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Nota guardada exitosamente.');
    } */
}

