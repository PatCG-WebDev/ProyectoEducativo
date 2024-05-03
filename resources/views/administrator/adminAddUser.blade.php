<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Añadir Usuario') }}</h2>

                    @if (session('success'))
                        <div class="bg-green-200 text-green-800 px-4 py-2 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('administrator.addUser') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="profile_id" class="block text-sm font-medium text-gray-700">{{ __('Perfil') }}</label>
                            <select name="profile_id" id="profile_id" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                                @foreach($profiles as $profile)
                                    <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                @endforeach
                            </select>
                            @error('profile_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" id="password" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">{{ __('Agregar') }}</button>
                            <a href="{{ route('administrator.showUsers') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
