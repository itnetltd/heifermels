<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Participant') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('participants.store') }}" class="space-y-6">
                    @csrf

                    {{-- Project --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Project <span class="text-red-500">*</span>
                        </label>
                        <select name="project_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"
                                required>
                            <option value="">Select project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Identification --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Participant UID
                                <span class="text-xs text-gray-400">(optional – auto-generated if empty)</span>
                            </label>
                            <input type="text" name="participant_uid" value="{{ old('participant_uid') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            @error('participant_uid')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                National ID
                            </label>
                            <input type="text" name="national_id" value="{{ old('national_id') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            @error('national_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Personal info --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Full name
                            </label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            @error('full_name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Gender
                            </label>
                            <select name="gender"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">Select</option>
                                <option value="Male" @selected(old('gender') === 'Male')>Male</option>
                                <option value="Female" @selected(old('gender') === 'Female')>Female</option>
                                <option value="Other" @selected(old('gender') === 'Other')>Other</option>
                            </select>
                            @error('gender')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Date of birth
                            </label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            @error('date_of_birth')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Phone
                            </label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                            @error('phone')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Location --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800 mb-2">Location</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700">
                                    Province
                                </label>
                                <input type="text" name="province" value="{{ old('province') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                @error('province')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700">
                                    District
                                </label>
                                <input type="text" name="district" value="{{ old('district') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                @error('district')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700">
                                    Sector
                                </label>
                                <input type="text" name="sector" value="{{ old('sector') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                @error('sector')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-700">
                                    Cell
                                </label>
                                <input type="text" name="cell" value="{{ old('cell') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                @error('cell')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-700">
                                    Village
                                </label>
                                <input type="text" name="village" value="{{ old('village') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                @error('village')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Flags --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_youth" value="1"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                   @checked(old('is_youth'))>
                            <span class="ml-2 text-sm text-gray-700">Youth (15–35 years)</span>
                        </label>

                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_person_with_disability" value="1"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                   @checked(old('is_person_with_disability'))>
                            <span class="ml-2 text-sm text-gray-700">Person with disability</span>
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 flex justify-between">
                        <a href="{{ route('participants.index') }}"
                           class="text-sm text-gray-600 hover:text-gray-900">
                            ← Back to list
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                            Save Participant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
