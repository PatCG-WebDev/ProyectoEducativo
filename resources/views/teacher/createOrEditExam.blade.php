<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form
                        @if(isset($exam)) 
                            action="{{ route('teacher.updateExam', ['exam' => $exam->id]) }}" 
                        @else 
                            action="{{ route('teacher.saveNewExam') }}" 
                        @endif
                        method="POST">
                        @csrf
                        @if(isset($exam))
                            @method('PUT')
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        @endif
                        <div class="mb-4">
                            <label for="name" class="block text-indigo-600 font-bold">{{ __('Nombre del Examen') }}</label>
                            <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{isset($exam) ? $exam->name : ''}}" required autofocus />
                        </div>
                        <div class="mb-4">
                            <label for="course" class="block text-indigo-600 font-bold">{{ __('Curso') }}</label>
                            <select id="course" name="course_id" class="block mt-1 w-full" required>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ isset($exam) && $course->id == $exam->course_id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="subject" class="block text-indigo-600 font-bold">{{ __('Asignatura') }}</label>
                            <select id="subject" name="subject_id" class="block mt-1 w-full" required>
                                @foreach($subjects as $subject)
                                    @if(isset($exam) && $subject->course_id == $exam->course_id)
                                        <option value="{{ $subject->id }}" {{ $subject->id == $exam->subject_id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($exam) ? __('Actualizar') : __('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadSubjects(courseId) {
                $.ajax({
                    url: "{{ url('courses') }}" + "/" + courseId + "/get-subjects-json",
                    method: 'GET',
                    success: function(response) {
                        $('#subject').empty();
                        $.each(response.subjects, function(key, value) {
                            $('#subject').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
            var initialCourseId = $('#course').val();
            loadSubjects(initialCourseId);
            $('#course').on('change', function() {
                var courseId = $(this).val();
                loadSubjects(courseId);
            });
        });
    </script>
</x-app-layout>
