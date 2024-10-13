<x-guest-layout>
    <div class="flex justify-center items-center p-4 h-[940px]">
        <!-- Imagen a la izquierda -->
        <div class="hidden md:block w-1/2 bg-gray-100 h-full">
            <img src="{{asset('imagenes/guest.jpg')}}"
                alt="Imagen de fondo"
                class="object-none h-full w-full rounded-l-lg shadow-lg">
        </div>

        <!-- Formulario a la derecha -->
        <div class="flex items-center justify-center w-full md:w-1/2 p-6 bg-white  shadow-md rounded-lg h-full">
            <div class="w-full">
                <!-- Logo -->
                <div class="flex justify-center mb-4 py-12">
                    <x-application-logo class="h-44 w-auto" />
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="flex justify-center">
                        <div class="w-3/4">
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex justify-center mt-4">
                        <div class="w-3/4">
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex justify-center mt-4">
                        <div class="w-3/4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded  border-gray-300  text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600 ">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Forgot Password and Login Button -->
                    <div class="flex justify-center mt-4">
                        <div class="w-3/4 flex items-center justify-between">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('Iniciar Sesión') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
