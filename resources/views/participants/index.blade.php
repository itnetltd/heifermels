<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participants') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash message --}}
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Small summary --}}
            <div class="mb-3 text-xs text-gray-500">
                Showing
                <span class="font-semibold">{{ $participants->total() }}</span>
                participant(s)
                @if(request('project_id'))
                    for project
                    <span class="font-semibold">
                        {{ optional($projects->firstWhere('id', request('project_id')))->code }}
                    </span>
                @endif
            </div>

            {{-- Filters + New button --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <form method="GET" action="{{ route('participants.index') }}" class="flex items-end gap-2">
                    <div>
                        <label for="project_id" class="block text-xs font-medium text-gray-600">
                            Project
                        </label>
                        <select id="project_id" name="project_id"
                                class="mt-1 block w-56 border-gray-300 rounded-md text-sm">
                            <option value="">All projects</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}"
                                    @selected(request('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 invisible">
                            Apply
                        </label>
                        <button type="submit"
                                class="px-3 py-1.5 bg-gray-100 border border-gray-300 rounded-md text-xs text-gray-700">
                            Filter
                        </button>
                    </div>
                </form>

                <div class="flex justify-end">
                    <a href="{{ route('participants.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                        + New Participant
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">UID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Project</th>
                            <th class="px-4 py-2 text-left">Gender</th>
                            <th class="px-4 py-2 text-left">District</th>
                            <th class="px-4 py-2 text-left">Phone</th>
                            <th class="px-4 py-2 text-left">Youth</th>
                            <th class="px-4 py-2 text-left">PWD</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $participant)
                            <tr class="border-t">
                                <td class="px-4 py-2 font-mono text-xs">
                                    {{ $participant->participant_uid }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $participant->full_name ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $participant->project?->code ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $participant->gender ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $participant->district ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $participant->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    @if($participant->is_youth)
                                        <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs">
                                            Yes
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($participant->is_person_with_disability)
                                        <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-xs">
                                            Yes
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">No</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('participants.edit', $participant) }}"
                                       class="text-indigo-600 text-xs">
                                        Edit
                                    </a>

                                    <form action="{{ route('participants.destroy', $participant) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 text-xs"
                                                onclick="return confirm('Delete this participant?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                                    No participants found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $participants->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
