<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        return view('Event.index');
    }

    public function vistaCreate(){
        return view('Event.create');
    }

    public function vistaEdit($id){
        $event = Event::find($id);
        return view('Event.edit', compact('event'));
    }
}