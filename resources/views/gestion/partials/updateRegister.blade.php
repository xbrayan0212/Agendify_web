<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-10"></div>

<!-- Modal -->
<section id="FormRegister" class="container max-w-screen-lg mx-auto bg-white p-12 rounded-lg shadow-lg mt-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 hidden">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-[#2B318A] text-4xl font-bold text-center mx-auto">Detalles</h1>
        <!-- Botón de cerrar modal -->
        <button id="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-lg">
            X
        </button>
    </div>

    <div class="p-8">
        <form action="{{ route('clientes.update') }}" method="POST" class="space-y-6">
            @method('PUT')
            @csrf
            @foreach ($atributos as $atributo)
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                <label for="{{ $atributo . 'Update' }}" class="text-lg font-medium text-gray-700 sm:w-1/6 text-left sm:text-right">
                    {{ ucfirst($atributo) }} :
                </label>
                <input type="text" name="{{ $atributo }}" id="{{ $atributo . 'Update'}}" class="border border-gray-300 rounded-lg p-3 w-full sm:w-3/4 focus:ring-2 focus:ring-[#2B318A] focus:border-transparent" placeholder="{{ ucfirst($atributo) }}" value="{{ old($atributo) }}">
            </div>
            @endforeach
            <input type="text" name="cedulaOld" id="cedulaOld" readonly>
            <div class="col-span-1 md:col-span-2 flex justify-center">
                <button type="submit" class="bg-blue-900 text-white rounded-md px-4 py-2 hover:bg-blue-800 transition duration-200">Modificar</button>
            </div>
        </form>
    </div>
</section>
