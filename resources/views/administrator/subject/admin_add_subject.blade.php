<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-black py-2 px-4 mb-4 text-white text-center">
                    <h2 class="text-2xl font-semibold mb-0">{{ __('Añadir Asignatura') }}</h2>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-alert type="success" />
                    <x-alert type="error" />

                    <form action="{{ route('administrator.add_subject') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre de la Asignatura') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="course_id" class="block text-sm font-medium text-gray-700">{{ __('Curso') }}</label>
                            <select name="course_id" id="course_id" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">{{ __('Agregar') }}</button>
                            <a href="{{ route('administrator.show_subjects') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">{{ __('Cancelar') }}</a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
