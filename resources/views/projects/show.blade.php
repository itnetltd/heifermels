<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project overview – {{ $project->code }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Top info card --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="text-sm text-gray-500">Project code</div>
                        <div class="text-lg font-semibold">{{ $project->code }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Duration</div>
                        <div class="text-sm">
                            {{ $project->start_date ? $project->start_date->format('Y-m-d') : 'N/A' }}
                            –
                            {{ $project->end_date ? $project->end_date->format('Y-m-d') : 'N/A' }}
                        </div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-500">Target households</div>
                        <div class="text-lg font-semibold">
                            {{ $project->target_households ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                @if($project->description)
                    <div class="mt-4 text-sm text-gray-700">
                        {{ $project->description }}
                    </div>
                @endif
            </div>

            {{-- Indicators table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 pt-4 pb-2 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-800">
                        Indicators for this project
                    </h3>

                    <a href="{{ route('indicators.index', ['project_id' => $project->id]) }}"
                       class="text-xs text-indigo-600">
                        Go to indicators list →
                    </a>
                </div>

                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Code</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Unit</th>
                        <th class="px-4 py-2 text-right">Baseline</th>
                        <th class="px-4 py-2 text-right">Target</th>
                        <th class="px-4 py-2 text-right">Latest value</th>
                        <th class="px-4 py-2 text-left">Latest period</th>
                        <th class="px-4 py-2 text-right">Achievement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($indicators as $indicator)
                        @php
                            $latestResult = $indicator->results
                                ->sortByDesc('period_date')
                                ->sortByDesc('id')
                                ->first();

                            $achievement = null;

                            if ($indicator->target_value
                                && $latestResult
                                && !is_null($latestResult->value)
                                && $indicator->target_value != 0
                            ) {
                                $achievement = ($latestResult->value / $indicator->target_value) * 100;
                            }

                            if (!is_null($achievement)) {
                                if ($achievement < 50) {
                                    $badgeClasses = 'bg-red-100 text-red-700';
                                } elseif ($achievement < 90) {
                                    $badgeClasses = 'bg-yellow-100 text-yellow-700';
                                } else {
                                    $badgeClasses = 'bg-green-100 text-green-700';
                                }
                            }
                        @endphp

                        <tr class="border-t">
                            <td class="px-4 py-2 font-mono text-xs">
                                {{ $indicator->code }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $indicator->unit ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                {{ $indicator->baseline_value ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                {{ $indicator->target_value ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-right">
                                @if($latestResult && !is_null($latestResult->value))
                                    {{ number_format($latestResult->value, 2) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($latestResult)
                                    {{ $latestResult->period_label ?? $latestResult->period_date->format('Y-m-d') }}
                                @else
                                    <span class="text-xs text-gray-400">No data</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right">
                                @if(!is_null($achievement))
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs {{ $badgeClasses }}">
                                        {{ number_format($achievement, 1) }}%
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                No indicators defined for this project yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('projects.index') }}"
                   class="text-sm text-gray-600">
                    ← Back to projects
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
