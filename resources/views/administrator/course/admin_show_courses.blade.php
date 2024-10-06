<x-app-layout>
    <div class="container py-4">
        <div class="text-center mb-4">
            <h1 class="display-6">{{ __('CURSOS') }}</h1>
            <a href="{{ route('administrator.add_course_form') }}" class="btn btn-primary">{{ __('Añadir Curso') }}</a>
        </div>

        <x-alert type="success" />
        <x-alert type="error" />

        <div class="table-responsive">
            <table class="table table-striped table-hover" style="width: 50%; margin: 0 auto;">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-align: center;">
                            <a href="{{ route('administrator.show_courses', ['order_by' => 'courses.name','order_direction' => $orderBy === 'courses.name' && $orderDirection === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                                {{ __('Nombre') }}
                                <x-order-arrow :orderBy="$orderBy" :currentOrderBy="'courses.name'" :orderDirection="$orderDirection" />
                            </a>
                        </th>
                        <th style="text-align: center;">{{ __('Acciones') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td style="text-align: center;">{{ $course->name }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('administrator.edit_course', ['courseId' => $course->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('administrator.delete_course', ['courseId' => $course->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Estás seguro de que quieres eliminar este curso?') }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
