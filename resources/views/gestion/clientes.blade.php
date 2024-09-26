<x-app-layout>
    <x-form-create
    title="Crear Cliente"
    :ruta="'dashboard'"
    >
    @foreach ($atributos as $atributo)
        <div class="mb-4">
            <x-input-label for="{{ $atributo }}" class="block text-stone-950 mb-2">{{ ucfirst($atributo) }}:</x-input-label>
            <input type="text" name="{{ $atributo }}" id="{{ $atributo }}" class="border border-stone-300 rounded-md p-2 w-full" placeholder="{{ ucfirst($atributo) }}">
        </div>
    @endforeach
    </x-form-create>
</x-app-layout>
