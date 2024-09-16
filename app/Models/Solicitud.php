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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_identity');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleSolicitud::class);
    }

}
