<div class="bg-white rounded-2xl shadow-lg mx-auto my-3 p-4 font-Poppins max-w-[1200px] min-h-96">
    <div>
        <h2 class="text-stone-950 text-left text-xl md:text-2xl lg:text-2xl my-4 px-4">{{ $title }}</h2>
        <div class="flex justify-end items-center mb-4">
            <label for="sort" class="mr-2 text-sm font-medium text-gray-700">Ordenar por:</label>
            <select name="sort" id="sort" class="w-full md:w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2">
                <option disabled selected>- Seleccionar -</option>
                @foreach ($atributos as $atributo)
                    <option class="p-2" value="{{$atributo}}">{{$atributo}}</option>
                @endforeach
            </select>

        </div>
    </div>
    <form action="{{$ruta}}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="min-w-full text-left divide-y divide-gray-200">
                <thead>
                    <tr class="text-sm font-medium text-gray-700 rounded-lg">
                        @foreach ($atributos as $atributo)
                            <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">{{$atributo}}</th>
                        @endforeach
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @foreach($atributos as $atributo)
                                <td class="px-6 py-4 border-b border-gray-200 text-gray-900">{{ $row[$atributo] }}</td>
                            @endforeach
                            <td class="flex items-center justify-center py-2">
                                <div class="flex space-x-2">
                                    <button class="bg-blue-500 text-white text-xs px-2 py-1 rounded hover:bg-blue-600 transition">Modificar</button>
                                    <button class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>
