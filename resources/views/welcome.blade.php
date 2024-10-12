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
            font-family: 'Poppins', sans-serif;
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
<body class="antialiased">
    <div class="relative w-full">
        <header class="flex items-center justify-between py-4 max-w-2xl px-6 lg:max-w-screen-2xl navbar">
            <div class="flex items-center space-x-3 h-8">
                <span class="title text-xl font-bold">Agendify</span>
            </div>
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] ">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20]">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link rounded-md px-3 py-2 ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] ">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
    </div>
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Sección de Bienvenida -->
            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-4">
                    <span class="text-black">Bienvenido a </span>
                    <span cltext-[#2B318A]ass="">Agendify</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-700 mb-4 text-center max-w-4xl mx-auto py-10 leading-9">
                    Un sistema intuitivo diseñado para ayudar a profesionales como consultores, abogados y médicos a gestionar sus citas y consultas con clientes o pacientes de manera eficiente.
                </p>
                <button class="bg-[#2B318A] text-white py-3 px-6 rounded-lg shadow-md hover:bg-[#1a1f5e] transition-colors transform hover:scale-105">
                    Comienza Ahora
                </button>
            </div>

            <section class="rounded-lg p-8 my-10">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/2 pr-6 mb-6 lg:mb-0">
                        <h3 class="text-4xl font-bold text-[#2B318A] my-4">Agenda Virtual</h3>
                        <p class="text-gray-700 my-4 max-w-lg text-justify leading-relaxed">
                            Organiza tus citas de manera eficiente con nuestra herramienta de agendamiento. Con nuestra plataforma, podrás programar, modificar y cancelar citas de forma rápida y sencilla, garantizando que nunca pierdas una oportunidad importante.
                        </p>
                        <p class="font-bold text-gray-600 my-2">Funcionalidades:</p>
                        <ul class="list-disc pl-5 text-gray-700 mt-2 mb-8 space-y-2">
                            <li>Selección de fecha y hora</li>
                            <li>Integración con clientes y servicios</li>
                            <li>Recordatorios automáticos</li>
                        </ul>
                    </div>
                    <div class="lg:w-1/2 flex items-center justify-center rounded-lg overflow-hidden">
                        <img src="{{ asset('imagenes/agenda.png') }}" alt="" class="w-full h-auto max-h-96 object-contain">
                    </div>
                </div>
            </section>

            <section class=" p-8 max-w-5xl mx-auto">
                <div class="text-center my-10">
                    <h3 class="text-4xl font-bold mb-16">Descubre Cómo Nuestro Software Mejora Tu Gestión del Tiempo y la Productividad Diaria</h3>
                    <p class="text-lg text-gray-700 leading-relaxed mx-auto max-w-3xl">
                        Nuestro software está diseñado para optimizar tu tiempo y aumentar tu eficiencia en la gestión de citas, tanto para clientes como para servicios. Con herramientas intuitivas y funcionalidades avanzadas, podrás concentrarte en lo que realmente importa mientras nosotros nos encargamos de simplificar tus tareas diarias.
                    </p>
                </div>
            </section>
            <!-- Sección de gestión de clientes -->
            <section class="rounded-lg p-8 my-10">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Descripción (lado izquierdo ) -->
                    <div class="w-full lg:w-1/2 flex items-center justify-center lg:justify-start">
                        <div class="pr-6 lg:pl-10 lg:py-8">
                            <h3 class="text-4xl font-bold text-[#2B318A] mb-6">Gestión de Clientes Y Citas</h3>
                            <p class="text-gray-700 mb-6 max-w-lg text-justify leading-relaxed">
                                Nuestra plataforma te permite gestionar eficientemente a tus clientes y sus citas. Visualiza estadísticas clave como clientes registrados, citas pendientes y citas atendidas.
                            </p>
                            <p class="font-bold text-gray-600 mb-4">Características:</p>
                            <ul class="list-disc pl-5 text-gray-700 space-y-3">
                                <li>Registro de clientes</li>
                                <li>Visualización de estadísticas mensuales</li>
                                <li>Historial detallado de citas</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Estadísticas (lado derecho) -->
                    <div class="w-full lg:w-1/2 grid grid-cols-1 gap-6">
                        <div class="bg-white shadow-md rounded-lg p-6 text-center transform transition duration-500 hover:scale-105">
                            <h2 class="text-gray-600 text-xl font-semibold mb-2">Clientes Registrados</h2>
                            <p class="text-4xl font-bold text-indigo-600">10</p>
                            <p class="text-gray-500 mt-2">Este mes</p>
                        </div>
                        <div class="bg-white shadow-md rounded-lg p-6 text-center transform transition duration-500 hover:scale-105">
                            <h2 class="text-gray-600 text-xl font-semibold mb-2">Citas Pendientes</h2>
                            <p class="text-4xl font-bold text-indigo-600">5</p>
                            <p class="text-gray-500 mt-2">Este mes</p>
                        </div>
                        <div class="bg-white shadow-md rounded-lg p-6 text-center transform transition duration-500 hover:scale-105">
                            <h2 class="text-gray-600 text-xl font-semibold mb-2">Citas Atendidas</h2>
                            <p class="text-4xl font-bold text-indigo-600">8</p>
                            <p class="text-gray-500 mt-2">Este mes</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('layouts.footer')
    </body>
</html>
