<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTools extends Model
{
    use HasFactory;

    protected $table = 'solicitud_tools'; // Nombre de la tabla correcto

    protected $fillable = [
        'user_identity',
        'cod_herramienta',
        'cantidad',
    ];

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'cod_herramienta');    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_identity');
    }
}
