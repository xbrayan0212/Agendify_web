<x-guest-layout>
    <div class="flex justify-center items-center p-4 h-[820px]">
        <!-- Imagen a la izquierda -->
        <div class="hidden md:block w-1/2 bg-gray-100 h-full">
            <img src="{{asset('imagenes/guest.jpg')}}"
                alt="Imagen de fondo"
                class="object-none h-full w-full rounded-l-lg shadow-lg">
        </div>


        <!-- Formulario a la derecha -->
        <div class="w-full md:w-1/2 p-6 bg-white shadow-md rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <x-application-logo class="h-44 w-auto" />
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="flex justify-center">
                    <div class="w-3/4">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                </div>

                <!-- Apellido -->
                <div class="flex justify-center mt-4">
                    <div class="w-3/4">
                        <x-input-label for="apellido" :value="__('Apellido')" />
                        <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autocomplete="family-name" />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="flex justify-center mt-4">
                    <div class="w-3/4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                
                <!-- Username -->
                <div class="flex justify-center mt-4">
                    <div class="w-3/4">
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div class="flex justify-center mt-4">
                    <div class="w-3/4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="flex justify-center mt-4">
                    <div class="w-3/4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <a class="underline text-base text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('¿Ya tienes una cuenta?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
