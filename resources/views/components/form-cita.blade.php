@props(['clientes', 'servicios', 'isUpdate' => false])

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 w-full">

        @if ($isUpdate == false)
        <div>
        <x-input-label id="cedula{{ $isUpdate ? 'Update' : '' }}" for="cedula{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Cédula:</x-input-label>
        <select name="cedula" id="cedula{{ $isUpdate ? 'Update' : '' }}" onchange="mostrarNombre(this)" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
            <option value="">Seleccione una cédula</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" data-nombre="{{ $cliente->nombre }} {{ $cliente->apellido }}">
                    {{ $cliente->cedula }}
                </option>
            @endforeach
        </select>
    </div>
        @endif


    <div>
        <x-input-label for="nombre{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Nombre:</x-input-label>
        <input type="text" id="nombre{{ $isUpdate ? 'Update' : '' }}" name="nombre" class="border border-stone-300 rounded-md p-2 w-full bg-gray-100 cursor-not-allowed" placeholder="Nombre" readonly>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div>
        <x-input-label for="fecha{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Fecha:</x-input-label>
        <input type="date" id="fecha{{ $isUpdate ? 'Update' : '' }}" name="fecha" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
    </div>

    <div>
        <x-input-label for="hora{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Hora:</x-input-label>
        <input type="time" id="hora{{ $isUpdate ? 'Update' : '' }}" name="hora" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">


    <div>
        <x-input-label for="servicio{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Servicio:</x-input-label>
        <select name="servicio" id="nombre_servicio{{ $isUpdate ? 'Update' : '' }}" class="border border-stone-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-stone-500">
            @foreach ($servicios as $option)
                <option value="{{ $option->id }}" data-nombre="$option->id ">{{ $option->nombre_servicio }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <x-input-label for="motivo{{ $isUpdate ? 'Update' : '' }}" class="block text-stone-950 mb-2">Motivo:</x-input-label>
        <input type="text" id="motivo{{ $isUpdate ? 'Update' : '' }}" name="motivo" class="border border-stone-300 rounded-md p-2 w-full" placeholder="Escribe el motivo aquí">
    </div>
</div>

<!-- Campo oculto para estado -->
<input type="hidden" name="estado" value="pendiente">
