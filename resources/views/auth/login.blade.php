
<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-6 bg-white shadow-md rounded-lg px-8 py-10">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">🔐 Login to Daffa Tani POS</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-sm text-gray-700" />
                <x-text-input id="email"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus
                              autocomplete="username"
                              class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-sm text-gray-700" />
                <x-text-input id="password"
                              type="password"
                              name="password"
                              required
                              autocomplete="current-password"
                              class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me"
                       type="checkbox"
                       class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
                       name="remember">
                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between flex-wrap gap-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-green-600 hover:underline">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <a href="{{ route('register') }}"
                   class="text-sm text-green-600 hover:underline">
                    {{ __('Create account?') }}
                </a>

                <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-sm font-semibold">
                    {{ __('Log in') }}
                </button>


            </div>
        </form>
    </div>
</x-guest-layout>
