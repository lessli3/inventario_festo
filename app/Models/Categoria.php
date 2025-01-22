<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Modelo para las categorías
class Categoria extends Model
{
    use HasFactory; // Utiliza el trait HasFactory para permitir la creación de fábricas

    protected $fillable = ['nombre']; // Campos que se pueden llenar masivamente

    // Define la relación con el modelo Herramienta
    public function herramientas()
    {
        return $this->hasMany(Herramienta::class); // Una categoría puede tener muchas herramientas
    }
}
