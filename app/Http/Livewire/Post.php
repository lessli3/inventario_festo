<?php

namespace App\Http\Livewire;

use App\Models\Herramienta;
use Livewire\Component;

class Post extends Component
{
    public function render()
    {
        $herramienta = Herramienta::all();

        return view('livewire.post', ['posts' => $herramienta]);
    }
}
