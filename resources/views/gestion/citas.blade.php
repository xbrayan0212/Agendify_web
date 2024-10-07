<x-app-layout>
    <x-form-create title="Agendar Cita" ruta="citas.guardar">
        <section class="col-span-1 md:col-span-2">
                <x-form-cita
                :clientes="$clientes"
                :servicios="$servicios"
                :atributos="$atributos"
                />
                </x-form-create>
            </section>

    <x-board-gestion
        title="Gestión de Citas"
        ruta="citas"
        :atributos="$atributos"
        :rows="$rows"
        :orders="['fecha', 'estado','nombre']"
        rutaDrop="citas.eliminar"
        rutaUpdate='citas.eliminar'
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
    <section>
        @include('gestion.partials.updateCita')
    </section>
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
        idCita=  document.getElementById("idCita")
        idCita.value = rowData["id"];
        idCita.style.display = "none";

      // Poner Opcion por default en el Select"
        var select = document.getElementById("nombre_servicioUpdate");
        var servicioNombre = rowData["nombre_servicio"];
        console.log(rowData)

        var selectEstado = document.getElementById("estadoUpdate");
        var estado = rowData["estado"];

        // Recorre las opciones del select
        for (var i = 0; i < select.options.length; i++) {
            // Verifica si el texto de la opción coincide con el nombre del servicio
            if (select.options[i].text === servicioNombre) {
                select.selectedIndex = i; // Selecciona la opción
                break; // Sale del bucle una vez que encuentra la opción
            }
            if (select.options[i].text === estado) {
                selectEstado.selectedIndex = i;
                break;
            }
        }



        }
</script>
