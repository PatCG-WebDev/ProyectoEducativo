<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 text-center">
                <h1 style="font-size: 2.00rem; font-weight: bold; text-align: center;">{{ __('USUARIOS') }}</h1>
                <a href="{{ route('administrator.addUserForm') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mt-2 inline-block">{{ __('Añadir Usuario') }}</a>
            </div>
            
            @if (session('success'))
                <div style="background-color: #34D399; color: #FFFFFF;" class="border border-green-600 px-4 py-2 rounded-md mb-4 shadow-md">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div style="background-color: #EF4444; color: #FFFFFF;" class="border border-red-700 px-4 py-2 rounded-md mb-4 shadow-md">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="text-center">
                <div class="inline-block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('ID') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('Profile ID') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('Nombre') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('Email') }}</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $index => $user)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-gray-100' }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->profile_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('administrator.editUser', ['userId' => $user->id]) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full">{{ __('Editar') }}</a>
                                    <form action="{{ route('administrator.deleteUser', ['userId' => $user->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este usuario?') }}')">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
