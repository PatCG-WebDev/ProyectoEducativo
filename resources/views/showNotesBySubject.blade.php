<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Mis Notas de '.$subject->name) }}
        </h2>
    </x-slot>

    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('Mis Notas de '.$subject->name) }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($notes->count() > 0)
                        <table class="min-w-full table-auto border">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border">Examen</th>
                                    <th class="py-2 px-4 border">Nota</th>
                                    <th class="py-2 px-4 border">Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                    <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : '' }}">
                                        <td class="py-2 px-4 border">{{ $note->exam }}</td>
                                        <td class="py-2 px-4 border">{{ $note->value }}</td>
                                        <td class="py-2 px-4 border">{{ $note->comment }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay notas disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
