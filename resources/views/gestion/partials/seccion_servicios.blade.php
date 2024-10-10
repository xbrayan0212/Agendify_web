<section class="bg-white rounded-2xl shadow-lg mx-auto my-3 p-6 font-Poppins max-h-full">
    <h1 class="text-neutral-950 text-left text-xl md:text-2xl lg:text-2xl font-semibold mb-6">Gestión de Servicios</h1>
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Tabla de Servicios -->
        <div class="w-full lg:w-2/3 rounded-lg max-h-72 overflow-y-auto ">
            <table class="min-w-full text-left">
                <thead >
                    <tr class="text-sm font-medium text-gray-700  rounded-lg">
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">Nombre</th>
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">Descripción</th>
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">Accion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($servicios as $servicio)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 border-b border-gray-200">{{ $servicio->nombre_servicio }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $servicio->descripcion }}</td>
                            <td class="px-6 py-4 border-b border-gray-200 text-center text-white text-xs    ">
                                <div class="flex space-x-2 justify-center">
                                    <button class="bg-indigo-700  p-2 mx-2  rounded modificar"   onclick="openModal({{ json_encode($servicio) }})">Modificar</button>
                                    <form action="{{route('eliminar.servicio',$servicio->id)}}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 p-2 mx-2 rounded">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Formulario para Crear Servicio -->
        <div class="w-full lg:w-1/3 bg-white rounded-lg  p-6 border border-gray-50">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Crear Servicio</h2>
            <form action="{{route('guardar.servicio')}}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="nombre" class="text-sm font-medium text-gray-600">Nombre del Servicio:</x-input-label>
                    <input type="text" id="nombre" name="nombre_servicio" class="mt-1 w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <x-input-label for="descripcion" class="text-sm font-medium text-gray-600">Descripción:</x-input-label>
                    <input type="text" id="descripcion" name="descripcion" class="mt-1 w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors">
                        Guardar Servicio
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>