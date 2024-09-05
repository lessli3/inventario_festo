<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SolicitudTools;


class SolicitudContador extends Component
{
    protected $listeners = ['updateSolicitudCount' => 'obtenerSolicitudCount'];

    public function render()
    {
        $this->obtenerSolicitudCount();

        return view('livewire.solicitud-contador');
    }

    public function obtenerSolicitudCount()
{
    if(auth()->check()) {
        $this->total = SolicitudTools::where('user_identity', auth()->user()->id)->count();
    } else {
        $this->total = 0;
    }
}
}
