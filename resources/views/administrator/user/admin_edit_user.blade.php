<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">{{ __('Editar Usuario') }}</h2>

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

                    <form action="{{ route('administrator.update_user') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="mb-4">
                            <label for="profile_id" class="block text-sm font-medium text-gray-700">{{ __('Perfil') }}</label>
                            <select name="profile_id" id="profile_id" class="form-select mt-1 block w-full">
                                @foreach($profiles as $profile)
                                    <option value="{{ $profile->id }}" {{ $user->profile_id == $profile->id ? 'selected' : '' }}>{{ $profile->name }}</option>
                                @endforeach
                            </select>
                            @error('profile_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-input mt-1 block w-full">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-input mt-1 block w-full">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" style="background-color: #3b82f6; margin-right: 8px;">{{ __('Actualizar') }}</button>
                            <a href="{{ route('administrator.show_users') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Cancelar') }}</a>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
