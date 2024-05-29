<x-app-layout>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="display-6">{{ __('USUARIOS') }}</h1>
            <a href="{{ route('administrator.add_user_form') }}" class="btn btn-primary">{{ __('Añadir Usuario') }}</a>
        </div>

        <x-alert type="success" />
        <x-alert type="error" />

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_users', ['order_by' => 'profiles.name', 'order_direction' => $orderBy === 'profiles.name' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Perfil') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'profiles.name'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_users', ['order_by' => 'users.name', 'order_direction' => $orderBy === 'users.name' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Nombre') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'users.name'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_users', ['order_by' => 'users.email', 'order_direction' => $orderBy === 'users.email' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Email') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'users.email'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">{{ __('Acciones') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td style="text-align: center;">{{ $user->profile->name }}</td>
                        <td style="text-align: center;">{{ $user->name }}</td>
                        <td style="text-align: center;">{{ $user->email }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('administrator.edit_user', ['userId' => $user->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('administrator.delete_user', ['userId' => $user->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este usuario?') }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</x-app-layout>
