<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex min-h-full flex-col justify-center px-6 py-4 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-20 w-auto" src="{{ asset('storage/images/tinygramlogo.png') }}" alt="TinyGram">
            <h2 class="mt-5 text-center text-2xl font-bold tracking-tight text-gray-900">TinyGram Login</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="{{ route('login') }}" class="space-y-3">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a class="font-semibold text-black" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                Remember Me
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded  border-gray-300  shadow-sm"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-800 ">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div>
                    <button type="submit"
                        class="btn btn-outline flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6  shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 ">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Or <a href="{{ route('register') }}"
                    class="font-semibold leading-6 text-black hover:text-gray-800">Create an
                    account</a>
            </p>
        </div>
    </div>

</x-guest-layout>
