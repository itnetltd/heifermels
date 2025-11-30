<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex justify-end mb-4">
                <a href="{{ route('projects.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                    + New Project
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Code</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Target HHs</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $project->code }}</td>
                                <td class="px-4 py-2">{{ $project->name }}</td>
                                <td class="px-4 py-2">{{ $project->target_households ?? '-' }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 text-xs">
    View
</a>
    
                                <a href="{{ route('projects.edit', $project) }}"
                                       class="text-indigo-600 text-xs">Edit</a>

                                    <form action="{{ route('projects.destroy', $project) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 text-xs"
                                                onclick="return confirm('Delete this project?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    No projects yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
