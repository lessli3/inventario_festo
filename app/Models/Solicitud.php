<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory; // Permite el uso de fábricas para crear instancias de modelo para pruebas

    protected $table = 'solicitudes'; // Define la tabla asociada en la base de datos

    protected $fillable = [
        'user_identity',  // Identificación del usuario que hace la solicitud
        'nombre',         // Nombre del solicitante
        'email',          // Correo electrónico del solicitante
        'telefono',       // Teléfono del solicitante
        'fecha',          // Fecha de la solicitud
        'hora',           // Hora de la solicitud
        'estado',         // Estado de la solicitud (ej. pendiente, aprobada, etc.)
    ];

    // Relación con el modelo de usuarios (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_identity');
    }

    // Relación con los detalles de la solicitud (DetalleSolicitud)
    public function detalles()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }
}
