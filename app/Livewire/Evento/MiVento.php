<?php

namespace App\Livewire\Evento;

use App\Models\Event;
use Livewire\Component;

class MiVento extends Component
{
    public $events;

    public function mount()
    {
        // Obtener eventos donde el user_id o fotografo_id sea igual al ID del usuario autenticado
        // o donde el email del usuario autenticado esté en la tabla de invitados
        $this->events = Event::where('user_id', auth()->id())
            ->orWhere('fotografo_id', auth()->id())
            ->orWhereHas('invitados', function ($query) {
                $query->where('email', auth()->user()->email);
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.evento.mi-vento', [
            'events' => $this->events,
        ]);
    }
}
