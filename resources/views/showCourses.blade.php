<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Cursos') }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                        <h2>Cursos del Profesor</h2>

                        @if ($courses)
                            @foreach($courses as $index => $course)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $course->name }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>No hay cursos disponibles.</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
