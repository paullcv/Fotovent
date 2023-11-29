<?php

namespace App\Livewire\Evento;

use App\Mail\Notificaciones;
use App\Models\Invitado;
use Illuminate\Support\Facades\Mail;
use Kreait\Laravel\Firebase\Facades\Firebase;
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

    public function enviarInvitacion($invitadoId)
    {
        $invitado = Invitado::find($invitadoId);

        // Obtener el evento asociado al invitado
        $event = $invitado->evento;

        if ($invitado) {
            Mail::to($invitado->email)->send(new Notificaciones($event));
        }

        $tokenfirebase = 'cUBZ61xgSwGJfnI-0yLQW6:APA91bEC17WRVi-PC99LoIxDg0HvC0EKwW2z43x35jHFqrSV8fnAMcPt5vxXJfYi6r4z62-YGjcEfWcvvGK6VDBUqZ-XvmYHeYBFzx_ubJaNUrKvvfiZ334H_r1O08z_p0k71RzPwd1G';

        $message = [
            'notification' => [
                'title' => '¡Apareces en una foto!',
                'body' => 'Usted fue identificado en una foto publicada por un fotógrafo del evento',
            ],
            'data' => [
                'key' => 'value',
            ],
            'token' => $tokenfirebase, // Especifica el token directamente aquí
        ];

        Firebase::messaging()->send($message);
    }


    public function render()
    {
        $invitados = Invitado::where('evento_id', $this->event->id)->get();

        return view('livewire.evento.invitados', ['invitados' => $invitados]);
    }
}
