<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 text-center">
                <h1 style="font-size: 2.00rem; font-weight: bold; text-align: center;">{{ __('ASIGNATURAS') }}</h1>
                <a href="{{ route('administrator.addSubjectForm') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-2 inline-block">{{ __('Añadir Asignatura') }}</a>
            </div>
            
            @if (session('success'))
                <div style="background-color: #34D399; color: #FFFFFF;" class="border border-green-600 px-4 py-2 rounded-md mb-4 shadow-md">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div style="background-color: #EF4444; color: #FFFFFF;" class="border border-red-700 px-4 py-2 rounded-md mb-4 shadow-md">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="text-center">
                <div class="inline-block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold cursor-pointer" data-order="id">ID</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold cursor-pointer" data-order="name">Nombre</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold cursor-pointer" data-order="course_id">Curso</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($subjects as $index => $subject)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-gray-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $subject->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $subject->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $subject->course_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('administrator.editSubject', ['subjectId' => $subject->id]) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full">{{ __('Editar') }}</a>
                                    <form action="{{ route('administrator.deleteSubject', ['subjectId' => $subject->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar esta asignatura?') }}')">{{ __('Eliminar') }}</button>
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const headers = document.querySelectorAll("th[data-order]");
        
        headers.forEach(header => {
            header.addEventListener("click", () => {
                const orderBy = header.getAttribute("data-order");
                window.location.href = `{{ route('administrator.showSubjects') }}?order_by=${orderBy}`;
            });
        });
    });
</script>

</x-app-layout>