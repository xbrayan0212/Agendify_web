<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Poppins', sans-serif; /* Cambiar a Poppins */
            }
            .nav-link {
                color: #2B318A; /* Color del texto */
            }
            .nav-link:hover {
                color: #2049ff; /* Color al hacer hover */
                background-color: rgba(47, 32, 255, 0.2); /* Fondo con un poco de contraste */
            }
            .title {
                color: #2B318A; /* Color del título */
                text-transform: uppercase; /* Mayúsculas */
            }
            .navbar {
                max-width: 1600px; /* Ancho máximo */
                margin: 0 auto; /* Centrar */
                width: 100%; /* Para ocupar el 100% del ancho disponible */
            }
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="relative w-full">
            <header class="flex items-center justify-between py-4 max-w-2xl px-6 lg:max-w-screen-2xl navbar">
                <!-- Logo and Name -->
                <div class="flex items-center space-x-3 h-8">
                    <!--<x-application-logo class="h-12 w-auto" />-->
                    <span class="title text-xl font-bold">Agendify</span>
                </div>

                <!-- Navigation Links (Login/Register) -->
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] "
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] "
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
        </div>
        <main class="bg-gray-100 py-12">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Sección de Bienvenida -->
                <div class="text-center mb-10">
                    <h1 class="text-6xl font-extrabold text-[#2B318A] mb-4 animate-pulse">
                        Bienvenido a Agendify
                    </h1>
                    <p class="text-xl text-gray-700 mb-8">
                        Un sistema intuitivo diseñado para ayudar a profesionales como consultores, abogados y médicos a gestionar sus citas y consultas con clientes o pacientes de manera eficiente.
                    </p>
                    <button class="bg-[#2B318A] text-white py-3 px-6 rounded-lg shadow-md hover:bg-[#1a1f5e] transition-colors transform hover:scale-105">
                        Comienza Ahora
                    </button>
                </div>

                <!-- Sección de Funcionalidades -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <!-- Sección 1: Calendario Integrado -->
                    <div class="bg-white shadow-xl rounded-lg p-8 flex flex-col items-start transition-transform transform hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-r from-[#FF2D20] to-[#FF6B6B] rounded-full">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 0a1 1 0 0 1 1 1v2h16V1a1 1 0 0 1 2 0v2h2a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h2V1a1 1 0 0 1 1-1zM1 4v18h22V4H1z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-[#2B318A] ml-4">Calendario Integrado</h2>
                        </div>
                        <p class="text-gray-700">
                            Reserva y gestiona tus citas de manera eficiente con nuestro calendario intuitivo, que te permite visualizar y organizar tus horarios con facilidad.
                        </p>
                    </div>

                    <!-- Sección 2: Notificaciones Automáticas -->
                    <div class="bg-white shadow-xl rounded-lg p-8 flex flex-col items-start transition-transform transform hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-r from-[#2B318A] to-[#5A7DCE] rounded-full">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2a10 10 0 0 1 10 10v6a2 2 0 0 1-2 2h-3v-3a7 7 0 0 0-14 0v3H4a2 2 0 0 1-2-2v-6a10 10 0 0 1 10-10zm0 14a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-[#2B318A] ml-4">Notificaciones Automáticas</h2>
                        </div>
                        <p class="text-gray-700">
                            Recibe recordatorios automáticos para tus citas, asegurando que nunca te pierdas una reunión importante ni olvides a tus pacientes.
                        </p>
                    </div>

                    <!-- Sección 3: Historial de Consultas -->
                    <div class="bg-white shadow-xl rounded-lg p-8 flex flex-col items-start transition-transform transform hover:scale-105">
                        <div class="flex items-center mb-4">
                            <div class="h-12 w-12 flex items-center justify-center bg-gradient-to-r from-[#FF2D20] to-[#FF6B6B] rounded-full">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6zm0 2h12v16H6V4zm2 3h8v2H8V7zm0 3h8v2H8v-2zm0 3h8v2H8v-2zm0 3h8v2H8v-2z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-semibold text-[#2B318A] ml-4">Historial de Consultas</h2>
                        </div>
                        <p class="text-gray-700">
                            Mantén un registro detallado de todas tus consultas y reuniones pasadas, facilitando un seguimiento adecuado de cada caso.
                        </p>
                    </div>
                </div>

                <!-- Sección Detallada de Funcionalidades -->
                <div class="mt-12">
                    <h2 class="text-4xl font-bold text-[#2B318A] mb-8">Funcionalidades Destacadas</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- Funcionalidad 1: Registrar Profesional -->
                        <div class="bg-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-[#2B318A] mb-4">Registrar Profesional</h3>
                            <p class="text-gray-700 mb-4">Únete a nuestro sistema ingresando tus datos y creando tu perfil.</p>
                            <p class="font-bold text-gray-600">Funcionalidades:</p>
                            <ul class="list-disc pl-5 text-gray-700 mt-2">
                                <li>Registro sencillo y rápido</li>
                                <li>Validación de datos</li>
                                <li>Perfil personalizable</li>
                            </ul>
                        </div>

                        <!-- Funcionalidad 2: Agendar Cita -->
                        <div class="bg-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-[#2B318A] mb-4">Agendar Cita</h3>
                            <p class="text-gray-700 mb-4">Organiza tus citas de manera eficiente con nuestra herramienta de agendamiento.</p>
                            <p class="font-bold text-gray-600">Funcionalidades:</p>
                            <ul class="list-disc pl-5 text-gray-700 mt-2">
                                <li>Selección de fecha y hora</li>
                                <li>Integración con clientes y servicios</li>
                                <li>Recordatorios automáticos</li>
                            </ul>
                        </div>

                        <!-- Funcionalidad 3: Visualizar Historial de Consultas -->
                        <div class="bg-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-[#2B318A] mb-4">Historial de Consultas</h3>
                            <p class="text-gray-700 mb-4">Consulta el registro de tus citas pasadas para ofrecer un mejor servicio.</p>
                            <p class="font-bold text-gray-600">Funcionalidades:</p>
                            <ul class="list-disc pl-5 text-gray-700 mt-2">
                                <li>Acceso rápido a registros anteriores</li>
                                <li>Posibilidad de agregar notas</li>
                                <li>Filtrado por cliente o fecha</li>
                            </ul>
                        </div>

                        <!-- Funcionalidad 4: Enviar Recordatorios de Cita -->
                        <div class="bg-white shadow-xl rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                            <h3 class="text-2xl font-semibold text-[#2B318A] mb-4">Recordatorios de Cita</h3>
                            <p class="text-gray-700 mb-4">Mantente informado con recordatorios automáticos sobre tus citas.</p>
                            <p class="font-bold text-gray-600">Funcionalidades:</p>
                            <ul class="list-disc pl-5 text-gray-700 mt-2">
                                <li>Alertas personalizadas por email y SMS</li>
                                <li>Configura horarios de envío</li>
                                <li>Opciones para cancelar o reprogramar</li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </main>



    </body>
</html>
