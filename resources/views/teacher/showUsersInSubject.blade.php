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
                                @foreach($exams as $exam)
                                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">{{ $exam->name }}</th>
                                @endforeach
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $even = true; @endphp
                            @foreach($users as $user)
                                <tr style="background-color: #f3f4f6">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    @foreach($exams as $exam)
                                        <td class="px-6 py-4 text-center">
                                            @if(isset($user->notes[$exam->id]))
                                                {{ $user->notes[$exam->id]->value }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('teacher.editNotes', ['userId' => $user->id, 'subjectId' => $subject->id]) }}" class="text-indigo-600 hover:text-indigo-900">Modificar</a>
                                    </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>
                    <a href="{{ route('teacher.addNotes', ['subjectId' => $subject->id]) }}" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-4">Añadir notas</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
