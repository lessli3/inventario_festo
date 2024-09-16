<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CarritoTools;
use App\Models\Herramienta;
use Illuminate\Support\Facades\Auth;


class Solicitudeslist extends Component
{
    public $solicitudItems;
    

    public function render()
    {
        return view('livewire.solicitudeslist');
    }
    
}
