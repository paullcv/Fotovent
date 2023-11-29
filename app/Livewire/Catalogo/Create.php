<?php

namespace App\Livewire\Catalogo;

use App\Models\Coincidencia;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Livewire\Component;
use Livewire\WithFileUploads; // Importa el trait necesario


class Create extends Component
{
    use WithFileUploads; // Agrega el trait
    protected $listeners = ["notificacionAparecesFoto"];

    public $image;
    public $price;
    public $eventId;
    public $message;
    public $imagepath;

    public $photoId;

    protected $rules = [
        'image' => 'required|image|max:4096',
        'price' => 'required|numeric',
        'eventId' => 'required|exists:events,id',
    ];


    public function save()
    {
        $this->validate();

        // Procesa el archivo de imagen, almacénalo y obtén la ruta
        $this->imagepath = $this->image->store('fotos', 'public');

        // Crea la foto en la base de datos
        $photo = auth()->user()->photos()->create([
            'image' => $this->imagepath,
            'price' => $this->price,
            'event_id' => $this->eventId,
        ]);
        // Almacena el id de la foto en una variable del componente
        $this->photoId = $photo->id;

        // Mostrar un mensaje de éxito
        session()->flash('message', 'Foto subida exitosamente.');

        $usuarios = [];

        $directorios = Storage::Directories('public/perfil');
        foreach ($directorios as $dir) {
            $carpeta = str_replace('public/perfil/', '', $dir);
            array_push($usuarios, $carpeta);
        }

        //dd($usuarios, $directorios );

        $this->dispatch('face-api', $usuarios);

        // Limpiar los campos después de la creación
        $this->reset(['image', 'price', 'eventId']);
    }

    public function notificacionAparecesFoto($idusuarios)
    {
        // Verifica si $this->photoId tiene un valor antes de utilizarlo
        if (!$this->photoId) {
            // Manejar el caso en que $this->photoId no tiene un valor
            session()->flash('error', 'Error: ID de foto no disponible.');
            return;
        }

        // Elimina IDs duplicados
        $idusuariosUnicos = array_unique($idusuarios);

        foreach ($idusuariosUnicos as $idusuario) {
            // Verifica si el id de usuario no es "unknown"
            if ($idusuario !== "unknown") {
                // Verifica si ya existe una coincidencia con la misma ruta de imagen y usuario
                $existeCoincidencia = Coincidencia::where('photo_id', $this->photoId)
                    ->where('user_id', $idusuario)
                    ->exists();

                // Si no existe, crea la coincidencia
                if (!$existeCoincidencia) {
                    Coincidencia::create([
                        'user_id' => $idusuario,
                        'photo_id' => $this->photoId
                    ]);
                    // Envía la notificación solo si es la primera vez que se encuentra la coincidencia
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
            }
        }
    }


    private function enviarNotificacionFirebase()
    {
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
        $events = Event::all(); // Asegúrate de obtener la lista de eventos
        return view('livewire.catalogo.create', compact('events'));
    }
}
