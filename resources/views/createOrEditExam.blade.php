<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ isset($exam) ? route('createOrEditExam', $exam->id) : route('createOrEditExam') }}" method="POST">
                        @csrf
                        @if(isset($exam))
                            @method('PUT')
                        @endif
                        
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nombre del Examen')" class="block text-indigo-600 font-bold" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($exam) ? $exam->name : ''" required autofocus />
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="course" :value="__('Curso')" class="block text-indigo-600 font-bold" />
                            <x-input id="course" class="block mt-1 w-full" type="text" name="course" :value="isset($exam) ? $course->name : ''" required />
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="subject" :value="__('Asignatura')" class="block text-indigo-600 font-bold" />
                            <x-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="isset($exam) ? $subject->name : ''" required />
                        </div>
                        
                        <!-- Otros campos del formulario -->

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($exam) ? __('Actualizar') : __('Guardar') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
