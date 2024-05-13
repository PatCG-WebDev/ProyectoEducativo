<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('teacher.save_exam') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-indigo-600 font-bold">{{ __('Nombre del Examen') }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                        </div>
                        <div class="mb-4">
                            <label for="course" class="block text-indigo-600 font-bold">{{ __('Curso') }}</label>
                            <select id="course" name="course_id" class="block mt-1 w-full" required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-indigo-600 font-bold">{{ __('Asignatura') }}</label>
                            <select id="subject" name="subject_id" class="block mt-1 w-full" required>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
