<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Mis Asignaturas') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4">Asignaturas en curso:</h3>

                    @if ($subjects->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">
                                        Asignatura
                                    </th>
                                    <th class="px-6 py-3 bg-indigo-500 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider">
                                        Notas
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $even = true; @endphp
                                @foreach($subjects as $index => $subject)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                            {{ $subject->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                            <a href="{{ route('student.showNotesBySubject', ['subject_id' => $subject->id]) }}" class="text-indigo-600 hover:text-indigo-900">Ver Notas</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay asignaturas disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

