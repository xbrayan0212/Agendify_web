<!-- Overlay -->
<div id="overlay" onclick="closeModal()" class="fixed inset-0 bg-black bg-opacity-50 hidden z-20"></div>

<!-- Modal -->
<div id="UpdateServicio" class="container max-w-screen-sm mx-auto bg-white p-8 rounded-lg shadow-lg mt-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 hidden">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-[#2B318A] text-2xl font-bold">Detalles del Servicio</h1>
        <button onclick="closeModal()" class="bg-red-500 text-white py-2 px-4 rounded-lg">X</button>
    </div>
    <form action="{{route('actualizar.servicio')}}" method="POST">
        @csrf
        @method('PUT')
        <!-- Nombre del Servicio -->
        <input id="idServicio" name="id" type="text" hidden readonly>
        <label for="nombre_servicio" class="block text-gray-700 font-semibold mb-2">Nombre del Servicio:</label>
        <input type="text" id="nombre_servicioUpdate" name="nombre_servicio" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        
        <!-- Descripción del Servicio -->
        <label for="descripcion" class="block text-gray-700 font-semibold mb-2">Descripción del Servicio:</label>
        <input type="text" id="descripcionUpdate" name="descripcion" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-6 focus:outline-none focus:ring-2 focus:ring-blue-400">
        
        <!-- Botón de Modificar -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-900 text-white py-2 px-4 rounded-lg hover:bg-blue-800 transition duration-200">Modificar</button>
        </div>
    </form>
</div>
