<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Code</label>
                        <input name="code" value="{{ old('code') }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('code') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input name="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Target households</label>
                        <input type="number" name="target_households" value="{{ old('target_households') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        @error('target_households') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        @error('description') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">Start date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('start_date') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700">End date</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            @error('end_date') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                            Save Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
