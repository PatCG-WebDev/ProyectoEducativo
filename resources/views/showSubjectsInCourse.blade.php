<x-app-layout>
{{--     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asignaturas en el curso de '.$course->name) }}
        </h2>
    </x-slot>
 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-semibold mb-4">Asignaturas:</h3>

                    @if ($subjects->count() > 0)
                            @foreach($subjects as $index => $subject)
                                <a href="{{ route('showUsersInSubject', ['subject_id' => $subject->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <p class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                        {{ $subject->name }}
                                </a> 
                            @endforeach
                    @else
                        <p>No hay asignaturas en este curso para usted.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

