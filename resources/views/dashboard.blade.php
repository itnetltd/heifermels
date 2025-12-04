{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#203746] leading-tight">
            {{ __('Heifer Rwanda MEL Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Top summary cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Projects
                    </p>
                    <p class="text-2xl font-bold text-[#203746] mb-1">
                        {{ $totalProjects }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Active Heifer Rwanda country projects.
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Participants
                    </p>
                    <p class="text-2xl font-bold text-[#203746] mb-1">
                        {{ $totalParticipants }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Registered households / farmers.
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Indicators
                    </p>
                    <p class="text-2xl font-bold text-[#203746] mb-1">
                        {{ $totalIndicators }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Defined MEL indicators across projects.
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                        Indicator Results
                    </p>
                    <p class="text-2xl font-bold text-[#203746] mb-1">
                        {{ $totalIndicatorResults }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Data points captured over time.
                    </p>
                </div>
            </div>

            {{-- Main menu tiles --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="text-sm font-semibold text-[#203746] mb-4">
                    Main Modules
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- Projects --}}
                    <a href="{{ route('projects.index') }}"
                       class="group block border border-gray-200 rounded-xl p-4 hover:border-[#203746] hover:shadow-sm transition">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Projects
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Manage Country Projects
                        </p>
                        <p class="text-xs text-gray-500 mb-2">
                            Create, edit and track Heifer Rwanda projects and coverage.
                        </p>
                        <span class="text-xs font-semibold text-[#203746] group-hover:underline">
                            Go to projects →
                        </span>
                    </a>

                    {{-- Participants --}}
                    <a href="{{ route('participants.index') }}"
                       class="group block border border-gray-200 rounded-xl p-4 hover:border-[#203746] hover:shadow-sm transition">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Participants
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Participants Registry
                        </p>
                        <p class="text-xs text-gray-500 mb-2">
                            Register and manage households / farmers, with full disaggregation.
                        </p>
                        <span class="text-xs font-semibold text-[#203746] group-hover:underline">
                            Go to participants →
                        </span>
                    </a>

                    {{-- Indicators --}}
                    <a href="{{ route('indicators.index') }}"
                       class="group block border border-gray-200 rounded-xl p-4 hover:border-[#203746] hover:shadow-sm transition">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Indicators
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Configure MEL Indicators
                        </p>
                        <p class="text-xs text-gray-500 mb-2">
                            Set units, baselines, targets and calculation logic for KPIs.
                        </p>
                        <span class="text-xs font-semibold text-[#203746] group-hover:underline">
                            Go to indicators →
                        </span>
                    </a>

                    {{-- Indicator Results --}}
                    <a href="{{ route('indicator-results.index') }}"
                       class="group block border border-gray-200 rounded-xl p-4 hover:border-[#203746] hover:shadow-sm transition">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Indicator Results
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Enter & Review Results
                        </p>
                        <p class="text-xs text-gray-500 mb-2">
                            Capture periodic results and compare progress vs targets.
                        </p>
                        <span class="text-xs font-semibold text-[#203746] group-hover:underline">
                            Go to results →
                        </span>
                    </a>
                </div>
            </div>

            {{-- Future dashboards section --}}
            <div class="bg-white border border-dashed border-gray-300 rounded-xl p-6">
                <h3 class="text-sm font-semibold text-[#203746] mb-1">
                    Analytics & Dashboards (coming soon)
                </h3>
                <p class="text-xs text-gray-500 mb-2">
                    This area will host links to Power BI / visualization dashboards for Heifer Rwanda projects.
                </p>
                <p class="text-xs text-gray-400">
                    Once integrated, you will be able to open interactive dashboards directly from here.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
