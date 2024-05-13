<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Editar Curso') }}</h2>

                    @if (session('message'))
                        <div class="bg-green-200 text-green-800 px-4 py-2 rounded-md mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-200 text-red-800 px-4 py-2 rounded-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-200 text-green-800 px-4 py-2 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('administrator.update_course') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="course_id" value="{{ $course->id }}">

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">{{ __('Actualizar') }}</button>
                            <a href="{{ route('administrator.show_courses') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-4">{{ __('Cancelar') }}</a>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
