<x-app-layout>
    <div class="container mx-auto p-4 ">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
            <!-- Lista de Clientes -->
            <x-table-component
                title="Lista de Clientes"
                :headers="['Nombre', 'Teléfono']"
                :rows="$clientes->map(fn($cliente) => [$cliente->nombre, $cliente->telefono])->toArray()"
            />

            <!-- Citas Agendadas -->
            <x-table-component
                title="Citas Agendadas"
                :headers="['Fecha', 'Hora', 'Estado']"
                :rows="$citas->map(fn($cita) => [$cita->fecha, $cita->hora, $cita->estado])->toArray()"
            />
        </div>

        <!-- Historial -->
        <x-table-component
            title="Historial"
            :headers="['Cliente', 'Fecha', 'Observaciones']"
            :rows="$historial->map(fn($entry) => [$entry->cita->cliente->nombre, $entry->fecha_consulta, $entry->observaciones])->toArray()"
        />
    </div>
</x-app-layout>
