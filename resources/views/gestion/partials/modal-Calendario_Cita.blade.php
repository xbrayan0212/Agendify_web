<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 justify-center items-center z-50 transition-opacity duration-300 hidden" style="margin-top: -10px;">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-80 md:w-96 relative">
        
        <!-- Botón de cierre -->
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-red-500 text-white px-2 py-1 rounded-full hover:bg-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Título -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Detalles de la Cita</h2>
        
        <!-- Contenido del Modal -->
        <div class="space-y-2 mb-6">
            <p><strong>Servicio:</strong> <span id="modal-servicio" class="text-gray-700"></span></p>
            <p><strong>Nombre:</strong> <span id="modal-nombre" class="text-gray-700"></span></p>
            <p><strong>Hora:</strong> <span id="modal-hora" class="text-gray-700"></span></p>
        </div>
        
        <!-- Formulario -->
        <form action="{{route('cambio_detalles_citas')}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="modal-estado" class="block text-gray-600 font-semibold">Cambiar Estado:</label>
                <select name="estado" id="select-modal-estado" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Finalizada">Finalizada</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>
            <div>
                <label for="observaciones" class="block text-gray-600 font-semibold">Agregar Observaciones:</label>
                <input type="text" id="observaciones" name="observaciones" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe aquí...">
            </div>
            <input type="text" name="id" id="modal-id_cita" hidden>
            <!-- Botón Enviar -->
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Enviar</button>
        </form>
    </div>
</div>
