<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Estudiantes de {{ $subject->name }}</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $even = true; @endphp
                            @foreach($users as $user)
                                <tr style="background-color: #f3f4f6">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="flex justify-end">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="background-color: #a5b4fc;">Nota</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="background-color: #a5b4fc;">Comentario</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="background-color: #ffffff;">
                                                        <td class="px-6 py-4">5.5</td>
                                                        <td class="px-6 py-4">Bien hecho!</td>
                                                    </tr>
                                                    <tr style="background-color: #ffffff;">
                                                        <td class="px-6 py-4">5.5</td>
                                                        <td class="px-6 py-4">Bien hecho!</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>
                    <a href="{{ route('showNotesBySubject', ['subject_id' => $subject->id]) }}" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">Añadir nota</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
