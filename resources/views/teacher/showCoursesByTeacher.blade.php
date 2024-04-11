<x-app-layout>
    <div class="py-12 flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" > <!-- Aumentado el ancho máximo del contenedor -->
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4">Cursos:</h3>

                    @if ($courses->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($courses as $course)
                                <a href="{{ route('teacher.showSubjectsInCourse', ['course_id' => $course->id]) }}" class="bg-white p-4 rounded-md hover:bg-gray-100 transition duration-300">
                                    <p class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                        {{ $course->name }}
                                    </p>
                                    <p class="text-gray-500">{{ $course->description }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No estás inscrito en ningún curso.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
