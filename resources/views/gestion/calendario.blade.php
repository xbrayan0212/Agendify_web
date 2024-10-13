<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Calendario de {{ $fechaActual->format('F Y') }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
            @foreach(['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $nombreDia)
                <div class="text-center font-semibold text-lg text-gray-700 bg-gray-200 p-2 rounded-md shadow-md hidden lg:block">{{ $nombreDia }}</div>
            @endforeach

            @for ($i = 0; $i < $inicioDelMes; $i++)
                <div></div> <!-- Espacio vacío para días previos -->
            @endfor

            @foreach ($meses as $dia)
                <div class="flex flex-col items-center justify-center border border-gray-300 rounded-lg bg-white shadow-md hover:shadow-xl transition duration-300 ease-in-out p-4">
                    <span class="text-3xl font-bold text-gray-800">{{ $dia['dia'] }}</span>
                    <div class="text-sm text-gray-600">{{ $dia['diaDeLaSemana'] }}</div>

                    <!-- Mostrar citas del día -->
                    @if(count($dia['citas']) > 0)
                        <div class="mt-2 space-y-1">
                            @foreach ($dia['citas'] as $cita)
                                @php
                                    // Mapeo de estados a clases de estilo
                                    $estadoClases = [
                                        'Cancelada' => 'bg-red-100 text-red-600',
                                        'Pendiente' => 'bg-blue-100 text-blue-600',
                                        'Finalizada' => 'bg-green-100 text-green-600',
                                    ];
                                    // Verificar si el estado de la cita está en el mapeo
                                    $claseEstado = $estadoClases[$cita['estado']] ?? null;
                                @endphp

                                @if ($claseEstado)
                                  <!-- Cada Cita -->
                                    <div onclick="openModal('{{$cita['id']}}','{{ $cita['servicio'] }}', '{{ $cita['nombre'] }}', '{{ $cita['hora'] }}', '{{ $cita['estado'] }}','{{$cita['observaciones']}}')" class="flex justify-between items-center text-xs {{ $claseEstado }} border border-gray-300 rounded-md p-2 transition duration-300 ease-in-out transform hover:scale-105 cursor-pointer">
                                        <div>
                                            <strong class="font-semibold">{{ $cita['servicio'] }}</strong> - {{ $cita['nombre'] }} a las 
                                            <span class="font-semibold text-gray-800">{{ $cita['hora'] }}</span>
                                            <br>
                                            <span class="font-semibold">{{ $cita['estado'] }}</span>
                                        </div>
                                    </div>

                                    <!-- Modal para  ver Detalles de la Cita -->
                                    @include('gestion.partials.modal-Calendario_Cita')
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="mt-2 text-gray-500 text-xs">No hay citas</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Controles para cambiar de mes -->
    <div class="flex justify-center mb-6 space-x-4">
        <a href="{{ route('calendario', ['date' => $fechaActual->copy()->subMonth()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Anterior</a>
        <a href="{{ route('calendario', ['date' => $fechaActual->copy()->addMonth()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Siguiente</a>
    </div>
</x-app-layout>
<script>
    function openModal(id, servicio, nombre, hora, estado) {
        // Asignar valores a los elementos del modal
        document.getElementById('modal-servicio').innerText = servicio;
        document.getElementById('modal-nombre').innerText = nombre;
        document.getElementById('modal-hora').innerText = hora;
        document.getElementById('modal-id_cita').value = id;
        
        // Seleccionar el estado actual en el select
        const estadoSelect = document.getElementById('select-modal-estado');
        estadoSelect.value = estado;

        // Mostrar el modal
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden'); // Quita la clase hidden
        modal.classList.add('flex', 'opacity-100'); 
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        
        // Cambia la opacidad antes de ocultar
        modal.classList.remove('opacity-100'); 
        modal.classList.add('opacity-0');

        // Espera un momento antes de ocultar el modal
        setTimeout(() => {
            modal.classList.add('hidden'); 
            modal.classList.remove('flex'); 
        }, 300); // Tiempo de transición 
    }
</script>

