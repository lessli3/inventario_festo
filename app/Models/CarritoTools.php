<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Modelo para el carrito de herramientas
class CarritoTools extends Model
{
    use HasFactory; // Utiliza el trait HasFactory para permitir la creación de fábricas

    protected $table = 'carrito_tools'; // Nombre de la tabla correcto

    protected $fillable = [
        'user_identity', // Identidad del usuario que solicita la herramienta
        'cod_herramienta', // Código de la herramienta
        'cantidad', // Cantidad de la herramienta solicitada
    ];

    // Define la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_identity'); // Un carrito pertenece a un usuario
    }

    // Define la relación con el modelo Herramienta
    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'cod_herramienta', 'cod_herramienta'); // Un carrito pertenece a una herramienta
    }
}
