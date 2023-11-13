<x-guest-layout>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
        @include('auth.loginCss')
            <div class="container">
                <div class="top-content">
                    <h1 style="font-weight: bold; color: blue">Welcome To Our Ecommerce</h1>
                    <h2>Sign in</h2>

                </div>
                <div class="inputs">
                    <input type="email" name="email" id="email" class="input" :value="old('email')" required autofocus >
                    <label for="email" class="input-label">Email or phone</label>

                </div>

                <div class="inputs">
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                </div>
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button class="next-btn">Next</button>

                </div>
            </div>
        </form>
</x-guest-layout>
