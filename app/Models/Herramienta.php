<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;

    public function descontarStock($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock -= $cantidad;
            $this->save(); 
            return true;
        }
        return false; 
    }

    public function agregarStock($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock += $cantidad;
            $this->save(); 
            return true;
        }
        return false; 
    }

}
