<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Modelo para las herramientas
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
        // Aumentar el stock de la herramienta
        $this->stock += $cantidad;  
        $this->save(); 
        return true;  
    }
    

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'id');
    }


}
