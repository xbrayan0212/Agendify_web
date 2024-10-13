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
    @include('gestion/partials.modal_mensajes')

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
        
        function soloLetras(e) {
        // Obtiene el código de la tecla presionada
        const key = e.key;

        // Comprueba si la tecla es una letra (a-z, A-Z) o una tecla de control (como Backspace)
        const regex = /^[a-zA-Z]+$/;

        // Permite la tecla si es una letra o una tecla de control
        if (!regex.test(key) && !['Backspace', 'Tab', 'Enter'].includes(key)) {
            e.preventDefault(); // Evita la entrada
        }
        }
        function soloNumeros(e) {
            const key = e.key;
            const regex = /^[0-9-]+$/; // Permite números y guiones

            // Permite la tecla si es un número, un guion o una tecla de control
            if (!regex.test(key) && !['Backspace', 'Tab', 'Enter'].includes(key)) {
                e.preventDefault(); // Evita la entrada
            }
        }   

        
        // Asignar el evento onkeypress a los inputs
        document.getElementById('nombre').addEventListener('keypress', soloLetras);
        document.getElementById('apellido').addEventListener('keypress', soloLetras);
        document.getElementById('cedula').addEventListener('keypress', soloNumeros);
        document.getElementById('telefono').addEventListener('keypress', soloNumeros);
        
         // Asignar el evento onkeypress a los inputs de actualización
         document.getElementById('nombreUpdate').addEventListener('keypress', soloLetras);
        document.getElementById('apellidoUpdate').addEventListener('keypress', soloLetras);
        document.getElementById('cedulaUpdate').addEventListener('keypress', soloNumeros);
        document.getElementById('telefonoUpdate').addEventListener('keypress', soloNumeros);
</script>


