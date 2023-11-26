<?php

namespace App\Livewire\Evento;

use App\Models\Invitado;
use Livewire\Component;

class Invitados extends Component
{
    public $event;
    public $nombre;
    public $email;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
    ];

    public function mount($event)
    {
        $this->event = $event;
    }

    public function crearInvitado()
    {
        $this->validate();

        Invitado::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'evento_id' => $this->event->id,
        ]);

        $this->reset(['nombre', 'email']);
    }

    public function eliminarInvitado($invitadoId)
    {
        $invitado = Invitado::find($invitadoId);

        if ($invitado) {
            $invitado->delete();
        }
    }

    public function render()
    {
        $invitados = Invitado::where('evento_id', $this->event->id)->get();

        return view('livewire.evento.invitados', ['invitados' => $invitados]);
    }
} 