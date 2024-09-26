<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-w-7xl mx-auto">
            <div class="flex justify-center">
                <x-figures-board
                    title="Clientes Registrados"
                    :cifra="$clientesRegistradosMes"
                    subtitle="En este mes"
                />
            </div>
            <div class="flex justify-center">
                <x-figures-board
                    title="Citas Pendientes"
                    :cifra="$citasPendientesMes"
                    subtitle="Para este mes"
                />
            </div>
            <div class="flex justify-center">
                <x-figures-board
                    title="Citas Atendidas"
                    :cifra="$citasFinalizadasMes"
                    subtitle="En este mes"
                />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Lista de Clientes -->
            <x-table-component
                title="Lista de Clientes"
                :headers="['Nombre', 'Teléfono']"
                :rows="$clientes->map(fn($cliente) => [$cliente->nombre . ' ' . $cliente->apellido, $cliente->telefono])->toArray()"
            />

            <!-- Citas Agendadas -->
            <x-table-component
                title="Citas Agendadas"
                :headers="['Fecha', 'Hora', 'Estado']"
                :rows="$citas->map(fn($cita) => [$cita->fecha, $cita->hora, $cita->estado])->toArray()"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6  mt-6">
            <!-- Historial -->
            <div class="flex flex-col ">
                <x-table-component
                    title="Historial"
                    :headers="['Cliente', 'Fecha', 'Observaciones']"
                    :rows="$historial->map(fn($entry) => [$entry->cita->cliente->nombre .' ' . $entry->cita->cliente->apellido, $entry->fecha_consulta, $entry->observaciones])->toArray()"
                />
            </div>

            <!-- Gráfico de Estado de Citas -->
            <div class="flex flex-col bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Estado de Citas</h2>
                <canvas id="estadoCitasChart" class="h-64"></canvas>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const ctx = document.getElementById('estadoCitasChart').getContext('2d');
    const estadoCitasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Total de Citas por Estado',
                data: {!! json_encode($totales) !!},
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
