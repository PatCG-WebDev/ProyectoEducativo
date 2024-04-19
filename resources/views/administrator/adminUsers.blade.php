<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            <div class="grid grid-cols-3 gap-6">
                @foreach($users as $user)
                    <div class="p-6 bg-white border-b border-gray-200 sm:rounded-lg" style="width: max-content;">
                        <table class="min-w-full divide-y divide-gray-200 mb-4 rounded-lg">
                            <thead class="bg-indigo-500 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider" colspan="4">{{ __('Usuario') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4">{{ __('ID') }}</td>
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4">{{ __('Profile ID') }}</td>
                                    <td class="px-6 py-4">{{ $user->profile_id }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4">{{ __('Nombre') }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4">{{ __('Email') }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-6 py-4" colspan="2">
                                        <a href="{{ route('editUser', ['id' => $user->id]) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">{{ __('Editar') }}</a>
                                        <form action="{{ route('deleteUser', ['id' => $user->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este usuario?') }}')">{{ __('Eliminar') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
