<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Indicator') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">

                <form method="POST" action="{{ route('indicators.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project *</label>
                        <select name="project_id"
                                class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Code *</label>
                            <input type="text" name="code" value="{{ old('code') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                            @error('code')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Unit</label>
                            <input type="text" name="unit" value="{{ old('unit') }}"
                                   placeholder="% , HHs, litres..."
                                   class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md text-sm">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Data type *</label>
                            <select name="data_type"
                                    class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                                @foreach(['number','percent','text','yes_no'] as $type)
                                    <option value="{{ $type }}" @selected(old('data_type') == $type)>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Frequency</label>
                            <select name="frequency"
                                    class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                                <option value="">--</option>
                                @foreach(['annual','semi-annual','quarterly','monthly','ad-hoc'] as $freq)
                                    <option value="{{ $freq }}" @selected(old('frequency') == $freq)>
                                        {{ ucfirst($freq) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center gap-4 mt-6 sm:mt-7">
                            <label class="inline-flex items-center text-sm text-gray-700">
                                <input type="checkbox" name="is_kpi" value="1"
                                       class="rounded border-gray-300"
                                       {{ old('is_kpi', true) ? 'checked' : '' }}>
                                <span class="ml-2">KPI</span>
                            </label>

                            <label class="inline-flex items-center text-sm text-gray-700">
                                <input type="checkbox" name="is_active" value="1"
                                       class="rounded border-gray-300"
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Baseline</label>
                            <input type="number" step="0.01" name="baseline_value"
                                   value="{{ old('baseline_value') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Target</label>
                            <input type="number" step="0.01" name="target_value"
                                   value="{{ old('target_value') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('indicators.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                            Save Indicator
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
