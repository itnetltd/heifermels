<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST"
                      action="{{ route('projects.update', $project) }}"
                      class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- Code --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Code <span class="text-red-500">*</span>
                        </label>
                        <input name="code"
                               value="{{ old('code', $project->code) }}"
                               required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm" />
                        @error('code')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input name="name"
                               value="{{ old('name', $project->name) }}"
                               required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm" />
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Target households --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Target households
                        </label>
                        <input type="number" name="target_households"
                               value="{{ old('target_households', $project->target_households) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm" />
                        @error('target_households')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <textarea name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Dates --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Start date
                            </label>
                            <input type="date" name="start_date"
                                   value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm" />
                            @error('start_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                End date
                            </label>
                            <input type="date" name="end_date"
                                   value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm" />
                            @error('end_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 flex justify-between">
                        <a href="{{ route('projects.index') }}"
                           class="text-sm text-gray-600 hover:text-gray-900">
                            ← Back to list
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
