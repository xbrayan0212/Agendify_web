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
       @include('gestion/partials.modal_mensajes')

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

        //cambio de hora dd 24 horas a 12 horas
        const hora12 = rowData["hora"]; // Suponiendo que tienes la hora en formato de 12 horas (ejemplo: "02:30 PM")
        const [time, modifier] = hora12.split(" ");
        let [hours, minutes] = time.split(":");
        
        if (modifier === "PM" && hours !== "12") {
            hours = parseInt(hours, 10) + 12; // Convertir a 24 horas
        } else if (modifier === "AM" && hours === "12") {
            hours = "00"; // Si es 12 AM, debe ser 00 horas
        }
        
        const hora24 = `${hours}:${minutes}`; // Formato 24 horas

        // Establecer el valor en el input de hora
        document.getElementById("horaUpdate").value = hora24;

        console.log(rowData);



        }
</script>
