<div class="container mx-auto p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($events as $event)
            <div class="border rounded-lg overflow-hidden shadow-md bg-white">
                <div class="p-4">
                    <div class="mb-4">
                        <h2 class="text-xl font-bold text-gray-800 text-center">{{ $event->nombre }}</h2>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-calendar mr-2"></i> <strong>Fecha:</strong> {{ $event->fecha }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-clock mr-2"></i> <strong>Hora:</strong> {{ $event->hora }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i> <strong>Ubicación:</strong> {{ $event->ubicacion }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-eye mr-2"></i> <strong>Visibilidad:</strong> {{ $event->visibilidad }}
                        </div>
                    </div>

                    <div class="text-center">
                        <!-- Mostrar la imagen QR -->
                        <img src="{{ asset($event->imageQR) }}" alt="QR Code" class="w-full h-auto">
                    </div>
                </div>

               
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <!-- Botones de Acción -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('evento.invitados', $event->id) }}" class="bg-blue-500 text-white p-2 text-center hover:bg-blue-600 transition duration-300 block">Add Invitados</a>
                        <a href="{{ route('evento.edit', $event->id) }}" class="text-gray-600 ml-2 hover:text-blue-500 focus:outline-none block">
                            <!-- Icono de Editar -->
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="#" wire:click="deleteEvent({{ $event->id }})" class="text-gray-600 hover:text-red-500 focus:outline-none block">
                            <!-- Icono de Eliminar -->
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </a>
                        <a href="{{ route('evento.fotografos', $event->id) }}" class="text-gray-600 hover:text-green-500 focus:outline-none block">
                            <!-- Icono de Fotógrafos -->
                            <i class="fas fa-camera"></i> Fotógrafos
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



