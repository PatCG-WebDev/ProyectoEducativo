<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('teacher.update_exam', ['exam' => $exam->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <div class="mb-4">
                            <label for="name" class="block text-indigo-600 font-bold">{{ __('Nombre del Examen') }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $exam->name }}" required autofocus />
                        </div>
                        <div class="mb-4">
                            <label for="course" class="block text-indigo-600 font-bold">{{ __('Curso') }}</label>
                            <select id="course" name="course_id" class="block mt-1 w-full" required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $course->id == $exam->course_id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-indigo-600 font-bold">{{ __('Asignatura') }}</label>
                            <select id="subject" name="subject_id" class="block mt-1 w-full" required>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $subject->id == $exam->subject_id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
