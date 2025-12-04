{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    {{-- Custom branded logo area for the login page --}}
    <x-slot name="logo">
        <div class="flex flex-col items-center">
            <x-application-logo class="h-12 w-auto" />

            <div class="mt-3 text-center">
                <p class="text-lg font-semibold text-gray-900">
                    Heifer Rwanda MEL System
                </p>
                <p class="text-xs text-gray-500 max-w-xs">
                    Sign in to manage projects, participants, indicators and results
                    for Heifer Rwanda country office projects.
                </p>
            </div>
        </div>
    </x-slot>

    {{-- Session status (e.g. "Password reset link sent") --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email address')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a
                        class="text-xs text-indigo-600 hover:text-indigo-500"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Keep me signed in') }}
                </span>
            </label>
        </div>

        {{-- Submit button --}}
        <div class="flex items-center justify-end">
            <x-primary-button class="w-full justify-center">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
