<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Indicator Result') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('indicator-results.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Project *
                        </label>
                        <select name="project_id"
                                class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Indicator *
                        </label>
                        <select name="indicator_id"
                                class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select indicator</option>
                            @foreach($indicators as $indicator)
                                <option value="{{ $indicator->id }}" @selected(old('indicator_id') == $indicator->id)>
                                    {{ $indicator->code }} - {{ $indicator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Period date *
                            </label>
                            <input type="date" name="period_date"
                                   value="{{ old('period_date') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Period label (e.g. 2025 Q1)
                            </label>
                            <input type="text" name="period_label"
                                   value="{{ old('period_label') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Numeric value
                            </label>
                            <input type="number" step="0.01" name="value"
                                   value="{{ old('value') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Text value (if qualitative)
                            </label>
                            <input type="text" name="value_text"
                                   value="{{ old('value_text') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Comment / notes
                        </label>
                        <textarea name="comment" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md">{{ old('comment') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('indicator-results.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                            Save result
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
