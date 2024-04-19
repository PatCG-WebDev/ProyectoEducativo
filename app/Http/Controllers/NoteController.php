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

   ////////////////////  TEACHER  ////////////////////////////////////////
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
        return view('teacher.addNotes', compact('subject', 'users', 'exams'));
    }
    

     public function saveNotes(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'exam.*' => 'required|string|max:255',
            'selected_users' => 'required|array',
            'selected_users.*' => 'exists:users,id',
            'value.*' => 'required|numeric|min:0|max:10', 
            'comment.*' => 'nullable|string|max:255',
        ]);

        // Utilizamos sólo los 
       $selectedUsers = $request->selected_users;

       //Iterar por los campos para guardarlos en la DDBB
        foreach ($selectedUsers as $userId) {

            Note::create([
                'user_id' => $userId,
                'subject_id' => $request->subject_id,
                'exam_id' => $request->exam,
                'value' => $request->notes[$userId]['value'],
                'comment' => $request->notes[$userId]['comment'],
            ]);
            
        }

        return redirect()->route('teacher.showUsersInSubject', ['subject_id' => $request->subject_id])->with('message', 'Notas añadidas correctamente');
    }


    public function showEditNotesForm($userId, $subjectId)
    {
        // Obtener el usuario y la asignatura específicos
        $user = User::find($userId);
        $subject = Subject::find($subjectId);

        // Verificar si el usuario y la asignatura existen
        if (!$user || !$subject) {
            // Si no existen, puedes redirigir o manejar el error de alguna otra manera.
            return redirect()->route('home')->with('error', 'Usuario o asignatura no encontrados.');
        }

        // Obtener las notas del usuario para la asignatura
        $notes = Note::where('user_id', $user->id)
                    ->where('subject_id', $subject->id)
                    ->get();

        // Retornar la vista para editar las notas
        return view('teacher.editNotes', compact('user', 'subject', 'notes'));
    }

    public function updateNotes(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'note_id' => 'required|exists:notes,id',
            'value' => 'required|numeric|min:0|max:10',
            'comment' => 'nullable|string|max:255',
        ]);

        // Obtener la nota a actualizar
        $note = Note::findOrFail($request->note_id);

        // Actualizar los valores de la nota
        $note->value = $request->value;
        $note->comment = $request->comment;
        $note->save();

        return redirect()->back()->with('message', 'Nota actualizada correctamente');
    }

    public function deleteNote(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'note_id' => 'required|exists:notes,id',
        ]);

        // Obtener la nota a eliminar
        $note = Note::findOrFail($request->note_id);

        // Eliminar la nota
        $note->delete();

        return redirect()->back()->with('message', 'Nota eliminada correctamente');
    }


     //////////////////////  STUDENT  ///////////////////////////////////////////////
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
             return view('student.showNotesBySubject', compact('subject','notes'));
         }
 
         // Si la asignatura no existe o no pertenece al usuario, puedes redirigir o manejar el error de alguna otra manera.
         return redirect()->route('home')->with('error', 'Asignatura no encontrada.');
     }

}

