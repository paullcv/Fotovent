@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Invitados
        </h2>
    </div>

    @livewire('evento.invitados', ['event' => $event])
@endsection
