<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Indicator Results') }}
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

            {{-- Filters + New --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                <form method="GET" action="{{ route('indicator-results.index') }}" class="flex flex-wrap items-end gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600" for="project_id">
                            Project
                        </label>
                        <select id="project_id" name="project_id"
                                class="mt-1 block w-48 border-gray-300 rounded-md text-sm">
                            <option value="">All projects</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected(request('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600" for="indicator_id">
                            Indicator
                        </label>
                        <select id="indicator_id" name="indicator_id"
                                class="mt-1 block w-56 border-gray-300 rounded-md text-sm">
                            <option value="">All indicators</option>
                            @foreach($indicators as $indicator)
                                <option value="{{ $indicator->id }}" @selected(request('indicator_id') == $indicator->id)>
                                    {{ $indicator->code }} - {{ $indicator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pb-1">
                        <button type="submit"
                                class="px-3 py-1.5 mt-5 bg-gray-100 border border-gray-300 rounded-md text-xs text-gray-700">
                            Filter
                        </button>
                    </div>
                </form>

                <div class="flex justify-end">
                    <a href="{{ route('indicator-results.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                        + New Result
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Project</th>
                        <th class="px-4 py-2 text-left">Indicator</th>
                        <th class="px-4 py-2 text-left">Value</th>
                        <th class="px-4 py-2 text-left">Label</th>
                        <th class="px-4 py-2 text-left">Entered by</th>
                        <th class="px-4 py-2 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($results as $result)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ $result->period_date->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $result->project?->code ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $result->indicator?->code ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if(!is_null($result->value))
                                    {{ number_format($result->value, 2) }}
                                @elseif($result->value_text)
                                    {{ Str::limit($result->value_text, 40) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ $result->period_label ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-xs text-gray-500">
                                {{ $result->creator->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('indicator-results.edit', $result) }}"
                                   class="text-indigo-600 text-xs">
                                    Edit
                                </a>

                                <form action="{{ route('indicator-results.destroy', $result) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 text-xs"
                                            onclick="return confirm('Delete this result?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                No results recorded.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $results->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
