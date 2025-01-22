<?php

namespace App\Http\Livewire;

use App\Models\Herramienta;
use Livewire\Component;

//Componente para el inventario
class Inventariolist extends Component
{
    public function render()
    {
        $herramienta = Herramienta::all();
        return view('livewire.inventariolist', ['inventario' => $herramienta]);
    }
}
