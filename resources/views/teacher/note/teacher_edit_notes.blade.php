<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Editar notas de {{ $user->name }} en {{ $subject->name }}</h3>
                    
                    
                    @if (session('message'))
                        <div style="background-color: #34D399; color: #FFFFFF;" class="border border-green-600 px-4 py-2 rounded-md mb-4 shadow-md">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Examen</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Nota</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Comentario</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                                <tr>
                                    <td class="px-6 py-4">{{ $note->exam->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $note->value }}</td>
                                    <td class="px-6 py-4 text-center">{{ $note->comment ?: 'N/A' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4" onclick="editNote({{ $note->id }})">Editar</button>
                                        <form action="{{ route('teacher.delete_note') }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="note_id" value="{{ $note->id }}">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="editNote{{ $note->id }}" style="display:none;">
                                    <td class="px-6 py-4" colspan="4">
                                        <form action="{{ route('teacher.update_notes') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="note_id" value="{{ $note->id }}">
                                            <div class="flex flex-col">
                                                <label for="value" class="font-semibold">Nota:</label>
                                                <input type="text" name="value" class="border rounded px-2 py-1">
                                                <label for="comment" class="font-semibold mt-2">Comentario:</label>
                                                <textarea name="comment" class="border rounded px-2 py-1"></textarea>
                                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">Guardar</button>
                                                <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-2" onclick="cancelEdit({{ $note->id }})">Cancelar</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function editNote(noteId) {
        document.getElementById('editNote' + noteId).style.display = 'table-row';
    }

    function cancelEdit(noteId) {
        document.getElementById('editNote' + noteId).style.display = 'none';
    }
</script>
