<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory; 

    protected $table = 'solicitudes'; 

    protected $fillable = [
        'user_identity',
        'nombre',         
        'email',          
        'telefono',       
        'fecha',          
        'hora',           
        'estado',         
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
