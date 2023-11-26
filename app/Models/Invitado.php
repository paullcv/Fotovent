<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','email','evento_id'];

    public function evento()
    {
        return $this->belongsTo(Event::class); // Corrección aquí
    }
}
