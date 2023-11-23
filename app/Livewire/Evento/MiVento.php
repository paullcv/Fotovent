<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use Livewire\Component;

class MiVento extends Component
{
    public $events;

    public function mount()
    {
        // Obtener eventos del usuario autenticado
        $this->events = auth()->user()->events;
    }

    public function render()
    {
        return view('livewire.evento.mi-vento', [
            'events' => $this->events,
        ]);
    }
}
