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

            @foreach($courses as $course)
                    <div class="p-6 bg-white border-b border-gray-200 sm:rounded-lg" style="width: max-content;">
                        <table class="min-w-full divide-y divide-gray-200 mb-4 rounded-lg">
                            <thead class="bg-indigo-500 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider" colspan="3">{{ $course->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examsByCourse[$course->id] as $exam)
                                    <tr class="bg-gray-50">
                                        <td class="px-6 py-4">{{ $exam->name }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('teacher.edit_exam', ['idExam' => $exam->id]) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('teacher.delete_exam', ['exam' => $exam->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <form action="{{ route('teacher.create_exam') }}" method="GET">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <button type="submit" class="inline-block bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear Examen</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
