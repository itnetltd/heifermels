<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Indicators') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <form method="GET" action="{{ route('indicators.index') }}" class="flex items-end gap-2">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Project</label>
                        <select name="project_id" class="mt-1 block w-56 border-gray-300 rounded-md text-sm">
                            <option value="">All projects</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected(request('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 invisible">Apply</label>
                        <button type="submit"
                                class="px-3 py-1.5 bg-gray-100 border border-gray-300 rounded-md text-xs text-gray-700">
                            Filter
                        </button>
                    </div>
                </form>

                <a href="{{ route('indicators.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                    + New Indicator
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Project</th>
                        <th class="px-4 py-2 text-left">Code</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Unit</th>
                        <th class="px-4 py-2 text-left">Type</th>
                        <th class="px-4 py-2 text-left">Freq.</th>
                        <th class="px-4 py-2 text-right">Baseline</th>
                        <th class="px-4 py-2 text-right">Target</th>
                        <th class="px-4 py-2 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($indicators as $indicator)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ $indicator->project?->code }}
                            </td>
                            <td class="px-4 py-2 font-mono text-xs">
                                {{ $indicator->code }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->unit ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->data_type }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->frequency ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                {{ $indicator->baseline_value ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                {{ $indicator->target_value ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('indicators.edit', $indicator) }}"
                                   class="text-indigo-600 text-xs">Edit</a>

                                <form action="{{ route('indicators.destroy', $indicator) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 text-xs"
                                            onclick="return confirm('Delete this indicator?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">
                                No indicators found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $indicators->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
