<div>
    <div class="navbar navbar-expand-md navbar-dark fixed-top bg-dark mb-4">
        <a class="navbar-brand text-monospace" href="#"> Buscar <i class="fas fa-search"></i></a>
        <input type="text" wire:model.debounce.300ms="search" class="form-control mr-sm-4" placeholder="Buscar...">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="text-align: center;">
                        <a href="#" wire:click.prevent="sortBy('profiles.name')" class="text-white">
                            {{ __('Perfil') }}
                            @if($orderBy === 'profiles.name')
                                @if($orderDirection === 'asc')
                                    &uarr;
                                @else
                                    &darr;
                                @endif
                            @endif
                        </a>
                    </th>
                    <th style="text-align: center;">
                        <a href="#" wire:click.prevent="sortBy('users.name')" class="text-white">
                            {{ __('Nombre') }}
                            @if($orderBy === 'users.name')
                                @if($orderDirection === 'asc')
                                    &uarr;
                                @else
                                    &darr;
                                @endif
                            @endif
                        </a>
                    </th>
                    <th style="text-align: center;">
                        <a href="#" wire:click.prevent="sortBy('users.email')" class="text-white">
                            {{ __('Email') }}
                            @if($orderBy === 'users.email')
                                @if($orderDirection === 'asc')
                                    &uarr;
                                @else
                                    &darr;
                                @endif
                            @endif
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
        {{ $users->links() }}
    </div>
</div>
