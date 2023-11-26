<div>
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
        Añadir de Invitados
    </h2>

    <!-- Formulario para crear un nuevo invitado -->
    <form wire:submit.prevent="crearInvitado">
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input wire:model="nombre" type="text" id="nombre" name="nombre" class="mt-1 p-2 border rounded-md w-full">
            @error('nombre') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input wire:model="email" type="email" id="email" name="email" class="mt-1 p-2 border rounded-md w-full">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
            Agregar Invitado
        </button>
    </form>

    <h2 class="text-2xl text-center font-semibold text-gray-900 dark:text-gray-200">
        Lista de Invitados
    </h2>
    <!-- Lista de invitados -->
    <table class="min-w-full mt-6">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-700">Nombre</th>
                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-700">Correo Electrónico</th>
                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-700">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invitados as $invitado)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-700 text-center">{{ $invitado->nombre }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-700 text-center">{{ $invitado->email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 dark:border-gray-700 text-center">
                        <button wire:click="eliminarInvitado({{ $invitado->id }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition duration-300">
                            Eliminar
                        </button>
                        <button wire:click="enviarInvitacion({{ $invitado->id }})" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 transition duration-300">
                            Enviar Invitación
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-2 px-4 text-center text-gray-500 dark:text-gray-400">No hay invitados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
