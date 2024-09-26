<div class="bg-white rounded-2xl shadow-lg mx-auto my-3 p-4 font-Poppins max-w-[1200px] min-h-96">
    <h2 class="text-stone-950 text-left text-xl md:text-2xl lg:text-2xl my-4 px-4">{{ $title }}</h2>

    <form action="{{ route($ruta) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 p-8">
        @csrf

        {{ $slot }}

        <div class="col-span-1 md:col-span-2 flex justify-center">
            <button type="submit" class="bg-blue-900 text-white rounded-md px-4 py-2 hover:bg-blue-800 transition duration-200">Guardar</button>
        </div>
    </form>
</div>
