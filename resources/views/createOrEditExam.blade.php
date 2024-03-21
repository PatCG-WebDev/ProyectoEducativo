<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- <form action="{{ isset($exam) ? route('editExam', $exam->id) : route('createExam') }}" method="POST"> --}}
                        <form action="{{ route('saveExam') }}" method="POST">

                        @csrf
                        {{-- verificación de si existe examen o no para mostrar edit o create --}}
                        @if(isset($exam))
                            @method('PUT')
                        @endif
                        
                        <div class="mb-4">
                            <label for="name" :value="__('Nombre del Examen')" class="block text-indigo-600 font-bold" />
                            <input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($exam) ? $exam->name : ''" required autofocus />
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
            // Función para cargar las asignaturas
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

            // Cargar las asignaturas al cargar la página con el primer curso seleccionado
            var initialCourseId = $('#course').val();
            loadSubjects(initialCourseId);

            // Evento change del elemento #course
            $('#course').on('change', function() {
                var courseId = $(this).val();
                loadSubjects(courseId);
            });
        });




        /* $(document).ready(function() {
            $('#course').on('change', function() {
                var courseId = $(this).val();
                $.ajax({
                    url : "{{ url('courses') }}" + "/" + courseId + "/get-subjects-json",
                    method: 'GET',
                    success: function(response) {
                        $('#subject').empty();
                        $.each(response.subjects, function(key, value) {
                            $('#subject').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        }); */
    </script>
</x-app-layout>
