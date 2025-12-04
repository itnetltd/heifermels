{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Heifer Rwanda MEL System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f5f7fa]">
<div class="min-h-screen flex flex-col">

    {{-- Top bar --}}
    <header class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <x-application-logo class="h-10 w-auto" />

                <div class="leading-tight">
                    <p class="text-sm font-semibold text-[#203746]">
                        Heifer International Rwanda
                    </p>
                    <p class="text-xs text-gray-500">
                        Digital Monitoring, Evaluation &amp; Learning (MEL) System
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center px-4 py-2 border border-[#203746] text-sm font-medium rounded-md text-[#203746] hover:bg-[#203746]/5">
                    Sign in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="hidden sm:inline-flex items-center px-4 py-2 bg-[#203746] text-sm font-medium rounded-md text-white hover:bg-[#172633]">
                        Request / Create Access
                    </a>
                @endif
            </div>
        </div>
    </header>

    {{-- Main content --}}
    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid lg:grid-cols-2 gap-10 items-center">

                {{-- Left: intro text --}}
                <div>
                    <p class="text-xs font-semibold tracking-wide text-[#203746] uppercase mb-2">
                        Heifer Rwanda – MEL System
                    </p>

                    <h1 class="text-3xl sm:text-4xl font-bold text-[#203746] mb-4">
                        Welcome to the Monitoring, Evaluation &amp; Learning Platform
                    </h1>

                    <p class="text-gray-700 text-sm sm:text-base mb-3">
                        Capture and manage data for Heifer Rwanda projects – from participants
                        and indicators to results over time.
                    </p>

                    <p class="text-gray-500 text-sm mb-6">
                        Use this tool to support evidence-based decision making, reporting on
                        KPIs, and learning across value chains and districts.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-5 py-2.5 rounded-md bg-[#203746] text-white text-sm font-medium hover:bg-[#172633]">
                            Sign in to continue
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-5 py-2.5 rounded-md border border-gray-300 text-sm font-medium text-gray-700 hover:bg-white">
                                Request access
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Right: feature cards --}}
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Projects
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Country Office Projects
                        </p>
                        <p class="text-xs text-gray-500">
                            Maintain project profiles, locations and target households.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Participants
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Household &amp; Farmer Data
                        </p>
                        <p class="text-xs text-gray-500">
                            Register participants and track key disaggregation (age, gender, youth, PWD).
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Indicators
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            KPIs &amp; Targets
                        </p>
                        <p class="text-xs text-gray-500">
                            Configure indicators, units, baselines and targets by project.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                        <p class="text-xs font-semibold text-[#203746] uppercase tracking-wide mb-1">
                            Results
                        </p>
                        <p class="text-sm font-medium text-gray-900 mb-1">
                            Time-series Tracking
                        </p>
                        <p class="text-xs text-gray-500">
                            Capture quarterly / annual results and compare with targets.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="border-t bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500">
            <span>&copy; {{ date('Y') }} Heifer International Rwanda. All rights reserved.</span>
            <span class="mt-1 sm:mt-0">
                Heifer Rwanda MEL System – Internal use only
            </span>
        </div>
    </footer>

</div>
</body>
</html>
