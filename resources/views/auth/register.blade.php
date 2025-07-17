<x-guest-layout>
    <div class="w-full max-w-md mx-auto  bg-white shadow-md rounded-lg px-6 sm:px-8 py-8 sm:py-10">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">📝 Register to Daffa Tani POS</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" class="text-sm text-gray-700" />
                <x-text-input id="name"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required
                              autofocus
                              autocomplete="name"
                              class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-sm text-gray-700" />
                <x-text-input id="email"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
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
                              autocomplete="new-password"
                              class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm text-gray-700" />
                <x-text-input id="password_confirmation"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password"
                              class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-sm" />
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('login') }}"
                   class="text-sm text-green-600 hover:underline">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit"
                        class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-sm font-semibold">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
