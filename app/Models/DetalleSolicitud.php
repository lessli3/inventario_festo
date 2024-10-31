<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    use HasFactory; // Utiliza el trait HasFactory para permitir la creación de fábricas

    protected $table = 'detalle_solicitudes'; // Define el nombre de la tabla correspondiente

    protected $fillable = ['solicitud_id', 'cod_herramienta', 'cantidad', 'estado']; // Campos que se pueden llenar masivamente

    // Define la relación con el modelo Herramienta
    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'cod_herramienta', 'cod_herramienta');
    }

    // Define la relación con el modelo Solicitud
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
