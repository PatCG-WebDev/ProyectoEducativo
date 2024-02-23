<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Note;
use App\Models\Subject;
use App\Models\Exam;
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

    public function showAddNotesForm($subjectId)
    {
        // Obtener la asignatura específica
        $subject = Subject::find($subjectId);
        
        // Verificar si la asignatura existe
        if (!$subject) {
            // Si la asignatura no existe, puedes redirigir o manejar el error de alguna otra manera.
            return redirect()->route('home')->with('error', 'Asignatura no encontrada.');
        }

        // Obtener los usuarios con perfil 3 asociados a la asignatura
        $users = $subject->users()->where('profile_id', 3)->get();

        //Obtener los examenes asociados a la asignatura
        $exams = Exam::where('subject_id', $subjectId)->get();

        // Retornar la vista para añadir notas
        return view('addNotes', compact('subject', 'users', 'exams'));
    }
    
    public function saveNotes(Request $request)
{
    // Validar los datos enviados
        $request->validate([
            'exam_id' => 'required|string|max:255',
            'selected_users' => 'required|array', // Asegúrate de que al menos un usuario esté seleccionado
            'selected_users.*' => 'exists:users,id', // Validar que cada usuario seleccionado exista en la base de datos
            'notes.*.value' => '', //required|numeric|min:0|max:10
            'notes.*.comment' => 'nullable|string|max:255',
        ]);

        // Obtener el examen seleccionado
        $examId = $request->exam_id;

        // Obtener los IDs de los alumnos seleccionados para agregar notas
        $selectedUsers = $request->selected_users;

        // Procesar solo los alumnos seleccionados
        foreach ($selectedUsers as $userId) {
            if (isset($request->notes[$userId])) {
                Note::create([
                    'user_id' => $userId,
                    'subject_id' => $request->subject_id,
                    'exam_id' => $examId,
                    'value' => $request->notes[$userId]['value'],
                    'comment' => $request->notes[$userId]['comment'] ?? null,
                ]);
            }
        }

        return redirect()->route('addNotes')->whith('message', 'Notas añadidas correctamente');
}

}

