<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Estudiantes de {{ $subject->name }}</h3>
                    <form action="{{ route('saveNotes') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                        
                        <label for="exam" class="block text-sm font-medium text-gray-700 mb-2">Examen:</label>
                        <select name="exam" id="exam" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-4">
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                        
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-indigo-500 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">E-mail</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Seleccionar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr style="background-color: #f3f4f6">
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4 flex justify-center items-center">
                                            <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                                        </td>
                                        <td class="px-6 py-4"><input type="text" name="notes[{{ $user->id }}][value]"></td>
                                        <td class="px-6 py-4"><input type="text" name="notes[{{ $user->id }}][comment]"></td>
                                    </tr>
                                @endforeach
  
                            </tbody>
                        </table>
                        <button type="submit" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>