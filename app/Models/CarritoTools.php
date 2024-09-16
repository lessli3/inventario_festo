<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoTools extends Model
{
    use HasFactory;

    protected $table = 'carrito_tools'; // Nombre de la tabla correcto

    protected $fillable = [
        'user_identity',
        'cod_herramienta',
        'cantidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_identity');
    }
    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'cod_herramienta', 'cod_herramienta');
    }

}
