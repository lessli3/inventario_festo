<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSolicitud extends Model
{
    use HasFactory;

    protected $table = 'detalle_solicitudes';
    protected $fillable = ['solicitud_id', 'cod_herramienta', 'cantidad', 'estado'];

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'cod_herramienta', 'cod_herramienta');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

}
