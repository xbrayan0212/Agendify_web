<x-app-layout>
    <div class="container"></div>
    <x-form-create title="Agendar Cita" ruta="citas.guardar">
        <!-- Campos del formulario -->
        <div class="mb-4">
            <x-input-label for="cedula" class="block text-stone-950 mb-2">Cédula:</x-input-label>
            <select name="cedula" id="cedula" onchange="mostrarNombre(this)" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
                <option value="">Seleccione una cédula</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" data-nombre="{{ $cliente->nombre }} {{ $cliente->apellido }}">
                        {{ $cliente->cedula }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-input-label for="nombre" class="block text-stone-950 mb-2">Nombre:</x-input-label>
            <input type="text" id="nombre" name="nombre" class="border border-stone-300 rounded-md p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Nombre" readonly>
        </div>

        <div class="mb-4">
            <x-input-label for="fecha" class="block text-stone-950 mb-2">Fecha:</x-input-label>
            <input type="date" id="fecha" name="fecha" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500" >
        </div>

        <div class="mb-4">
            <x-input-label for="hora" class="block text-stone-950 mb-2">Hora:</x-input-label>
            <input type="time" id="hora" name="hora" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500" >
        </div>

        <div class="mb-4">
            <x-input-label for="servicio" class="block text-stone-950 mb-2">Servicio:</x-input-label>
            <select name="servicio" id="servicio" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
                @foreach ($servicios as $option)
                    <option value="{{ $option->id }}">{{ $option->nombre_servicio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-input-label for="motivo" class="block text-stone-950 mb-2">Motivo:</x-input-label>
            <input type="text" id="motivo" name="motivo" class="border border-stone-300 rounded-md p-2 w-full" placeholder="Escribe el motivo aquí">
        </div>
    </x-form-create>

    <x-board-gestion
        title="Gestión de Citas"
        ruta="citas"
        :atributos="$atributos"
        :rows="$rows"
        :orders="['fecha', 'estado','nombre']"
        rutaDrop="citas.eliminar"
        ></x-board-gestion>

       <!-- Modal para mensajes -->
       <x-modal name="messageModal" :show="session('success') || session('error') || $errors->any()" maxWidth="sm">
        <div class="bg-white rounded-lg shadow-lg p-6">
            @if (session('success'))
                <h2 class="text-lg font-bold text-green-600 mb-2">Éxito</h2>
                <p class="text-gray-700">{{ session('success') }}</p>
            @elseif (session('error'))
                <h2 class="text-lg font-bold text-red-600 mb-2">Error</h2>
                <p class="text-gray-700">{{ session('error') }}</p>
            @endif
            @if ($errors->any())
                <h2 class="text-lg font-bold text-red-600 mb-2">Errores de Validación</h2>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <button @click="show = false" class="mt-4 bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                Cerrar
            </button>
        </div>
    </x-modal>
</x-app-layout>

<script>

    document.getElementById('sort').addEventListener('change', function() {
        this.form.submit();
    });

    function mostrarNombre(select) {
        const selectedOption = select.options[select.selectedIndex];
        const nombreCompleto = selectedOption.getAttribute('data-nombre');
        const inputNombre = document.getElementById('nombre');
        inputNombre.value = nombreCompleto || '';
    }
</script>
