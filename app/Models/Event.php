<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion','ubicacion', 'fecha', 'hora','visibilidad', 'user_id'];

    //Relacion uno a muchos con User
    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
