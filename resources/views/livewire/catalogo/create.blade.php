<div>
<div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium mb-2 text-gray-600">Imagen:</label>
            <input wire:model="image" type="file" id="image" class="hidden">
            <label for="image" class="cursor-pointer bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 w-full">
                {{ $image ? 'Cambiar Imagen' : 'Seleccionar Imagen' }}
            </label>
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        @if ($image)
            <div class="mb-4">
                <p class="block text-sm font-medium text-gray-600">Previsualización:</p>
                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="mt-2 w-full object-cover rounded-md">
            </div>
        @endif

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-600">Precio Bs:</label>
            <input wire:model="price" type="number" id="price" class="mt-1 p-2 border rounded-md w-full">
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="eventId" class="block text-sm font-medium text-gray-600">Evento:</label>
            <select wire:model="eventId" id="eventId" class="mt-1 p-2 border rounded-md w-full">
                <option value="">Seleccione un evento</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}">{{ $event->nombre }}</option>
                @endforeach
            </select>
            @error('eventId') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-300 w-full">
            Subir Foto
        </button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative">
            <span class="block sm:inline">{{ session('message') }}</span>
            <button wire:click="$set('message', null)" class="absolute top-0 right-0 p-2">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif
</div>
</div>