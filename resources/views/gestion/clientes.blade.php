<x-app-layout>

    <!--Form para crear Cliente-->
    <x-form-create
        title="Crear Cliente"
        ruta="clientes.guardar"
    >
    @foreach ($atributos as $atributo)
        <div class="mb-4">
            <x-input-label for="{{ $atributo }}" class="block text-stone-950 mb-2">{{ ucfirst($atributo) }}:</x-input-label>
            <input type="text" name="{{ $atributo }}" id="{{ $atributo }}" class="border border-stone-300 rounded-md p-2 w-full" placeholder="{{ ucfirst($atributo) }}" value="{{ old($atributo) }}">
            @if ($errors->has($atributo))
                <span class="text-red-600 text-sm">{{ $errors->first($atributo) }}</span>
            @endif
        </div>
    @endforeach
    </x-form-create>

    <!--Tablero para gestion de  Cliente-->
    <x-board-gestion
        title="Gestionar Cliente"
        ruta="clientes"
        :atributos="$atributos"
        :rows="$rows"
        :orders="$atributos"
        rutaDrop="clientes.eliminar"
        rutaUpdate="clientes.eliminar"
    >
    </x-board-gestion>

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

    @include('gestion.partials.updateRegister')
</x-app-layout>

<script>
    document.getElementById('sort').addEventListener('change', function() {
        this.form.submit();
    });

    function openModal(rowData) {
        const openModalButtons = document.querySelectorAll('.modificar');
        const modal = document.getElementById('FormRegister');
        const overlay = document.getElementById('overlay');

        // Agregar el evento de click a cada botón
        openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.remove('hidden');
                overlay.classList.remove('hidden'); // Mostrar el overlay
            });
        });

        // Obtener el botón de cerrar y agregar la funcionalidad para ocultar el modal y el overlay
        const closeModalButton = document.getElementById('closeModal');
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            overlay.classList.add('hidden'); // Ocultar el overlay
        });

        @foreach ($atributos as $atributo)
            document.getElementById("{{ $atributo .'Update'}}").value = rowData["{{ $atributo }}"];
        @endforeach
        cedulaOld = document.getElementById("cedulaOld");
        cedulaOld.value= rowData["cedula"];
        cedulaOld.style.display = "none";
        }
</script>


