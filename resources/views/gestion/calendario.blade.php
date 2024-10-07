<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Calendario de {{ $currentDate->format('F Y') }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
            @foreach(['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dayName)
                <div class="text-center font-semibold text-lg text-gray-700 bg-gray-200 p-2 rounded-md shadow-sm hidden lg:block">{{ $dayName }}</div>
            @endforeach

            @for ($i = 0; $i < $startOfMonth; $i++)
                <div></div> <!-- Espacio vacío para días previos -->
            @endfor

            @foreach ($months as $day)
                <div class="flex flex-col items-center justify-center border border-gray-300 rounded-lg bg-white shadow-md hover:shadow-lg transition duration-300 ease-in-out p-4">
                    <span class="text-3xl font-bold text-gray-800">{{ $day['day'] }}</span>
                    <div class="text-sm text-gray-600">{{ $day['dayOfWeek'] }}</div>

                    <!-- Mostrar citas del día -->
                    @if(count($day['citas']) > 0)
                        <div class="mt-2 space-y-1">
                            @foreach ($day['citas'] as $cita)
                                <div class="text-xs text-gray-600 bg-blue-100 border border-blue-300 rounded-md p-2 transition duration-300 ease-in-out transform hover:scale-105">
                                    <strong class="text-blue-600">{{ $cita['servicio'] }}</strong> - {{ $cita['nombre'] }} a las <span class="font-semibold text-gray-800">{{ $cita['hora'] }}</span>
                                </div>
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
        <a href="{{ route('calendario', ['date' => $currentDate->copy()->subMonth()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Anterior</a>
        <a href="{{ route('calendario', ['date' => $currentDate->copy()->addMonth()->format('Y-m-d')]) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Siguiente</a>
    </div>

</x-app-layout>
