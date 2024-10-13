<div class="bg-white rounded-2xl shadow-lg mx-auto my-3 p-8 font-Poppins max-w-[1200px] min-h-96">
    <div>
        <h2 class="text-stone-950 text-left text-xl md:text-2xl lg:text-2xl my-4 px-4">{{ $title }}</h2>
        <form action="{{ route($ruta) }}" method="GET">
            <div class="flex justify-end items-center mb-4">
                <label for="sort" class="mr-2 text-sm font-medium text-gray-700">Ordenar por:</label>
                <select name="sort" id="sort" class="w-full md:w-64 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2">
                    <option disabled selected>- Seleccionar -</option>
                    @foreach ($orders as $order)
                        <option value="{{ $order }}" {{ request('sort') == $order ? 'selected' : '' }}>{{ ucfirst($order) }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
        <div class="overflow-x-auto  min-h-96">
            <table class="min-w-full text-left divide-y divide-gray-200  ">
                <thead>
                    <tr class="text-sm font-medium text-gray-700 rounded-lg">
                        @foreach ($atributos as $atributo)
                            <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">{{$atributo}}</th>
                        @endforeach
                        <th class="px-6 py-3 border-b border-gray-200 sticky top-0 z-10 bg-blue-50">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 ">
                    @foreach ($rows as $row)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @foreach($atributos as $atributo)
                                <td class="px-6 py-4 border-b border-gray-200 text-gray-900">{{ $row[$atributo] }}</td>
                            @endforeach
                            <td class="flex items-center justify-center py-2">
                                <div class="flex space-x-2">
                                    <button type="button" class="bg-indigo-600 text-white p-2 text-xs rounded modificar" onclick="openModal({{ json_encode($row) }})">Modificar</button>
                                        <form action="{{ route($rutaDrop, $row['id']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-600 p-2  text-white text-sm  rounded">Eliminar</button>
                                        </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
