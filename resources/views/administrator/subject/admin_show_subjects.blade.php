<x-app-layout>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="display-6">{{ __('ASIGNATURAS') }}</h1>
            <a href="{{ route('administrator.add_subject_form') }}" class="btn btn-primary">{{ __('Añadir Asignatura') }}</a>
        </div>

        <x-alert type="success" />
        <x-alert type="error" />

        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 50%; margin: 0 auto;">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_subjects', ['order_by' => 'subjects.name', 'order_direction' => $orderBy === 'subjects.name' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Nombre') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'subjects.name'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_subjects', ['order_by' => 'courses.name', 'order_direction' => $orderBy === 'courses.name' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Curso') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'courses.name'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">{{ __('Acciones') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td style="text-align: center;">{{ $subject->name }}</td>
                        <td style="text-align: center;">{{ $subject->course->name }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('administrator.edit_subject', ['subjectId' => $subject->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('administrator.delete_subject', ['subjectId' => $subject->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar esta asignatura?') }}')">
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
            {{ $subjects->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</x-app-layout>
