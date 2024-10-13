<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-10"></div>

<!-- Modal -->
<section id="FormRegister" class="container max-w-screen-lg mx-auto bg-white p-12 rounded-lg shadow-lg mt-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 hidden">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[#2B318A] text-4xl font-bold text-center mx-auto">Detalles</h1>
        <button id="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-lg">X</button>
    </div>
    <form action="{{ route('citas.update') }}" method="POST" class="space-y-6">
        @method('PUT')
        @csrf

        <x-form-cita
            :clientes="$clientes"
            :servicios="$servicios"
            :isUpdate="true"
            :atributos="$atributos"
        />
        <x-input-label for="estado" class="block text-stone-950 mb-2">Estado: </x-input-label>
        <select name="estado" id="estadoUpdate" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
            <option value="Cancelada">Cancelada</option>
            <option value="Finalizada">Finalizada</option>
            <option value="Pendiente">Pendiente</option>
        </select>

        <input type="text" id="idCita" name="idCita" readonly>
        <!-- Botón para enviar el formulario -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-900 text-white py-2 px-4 mx-auto rounded-lg hover:bg-blue-800 transition duration-200">Modificar</button>
        </div>
    </form>
</section>
