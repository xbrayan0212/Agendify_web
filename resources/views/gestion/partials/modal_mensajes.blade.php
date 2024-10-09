         <!-- Modal para mensajes -->
         <x-modal name="messageModal" :show="session('success') || session('error') || $errors->any()" maxWidth="sm">
            <div class="bg-white rounded-lg shadow-lg p-6">
                @if (session('success'))
                    <h2 class="text-lg font-bold text-green-600 mb-2">Éxito</h2>
                    <p class="text-gray-700">{{ session('success') }}</p>
                @elseif (session('error'))
                    <h2 class="text-lg font-bold text-red-600 mb-2">Error</h2>
                    <p class="text-gray-700">{{ session('error') }}</p>
                @endif
                @if ($errors->any())
                    <h2 class="text-lg font-bold text-red-600 mb-2">Errores de Validación</h2>
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <button @click="show = false" class="mt-4 bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                    Cerrar
                </button>
            </div>
        </x-modal>