<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Asignaturas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Asignaturas en curso:</h3>
                    
                    @if ($subjects)
                        <ul>
                            @foreach($subjects as $subject)
                                <li>{{ $subject->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No tiene ninguna asignatura.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>