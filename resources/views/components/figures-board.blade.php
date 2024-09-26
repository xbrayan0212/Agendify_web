@props(['title', 'cifra', 'subtitle'])

<div class="bg-white rounded-2xl shadow-lg mx-auto my-5 p-6 font-Poppins min-h-40 transition-transform duration-300 transform hover:scale-105 w-full max-w-[400px]"> <!-- Ajusta max-w según sea necesario -->
    <h2 class="text-neutral-950 text-left text-lg md:text-xl lg:text-xl font-semibold my-2">{{ $title }}</h2>
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-2 text-center border-indigo-200 pb-1">{{ $cifra }}</h1>
    <h3 class="text-gray-600 text-left text-base md:text-lg lg:text-lg font-medium my-2 italic">{{ $subtitle }}</h3>
</div>
