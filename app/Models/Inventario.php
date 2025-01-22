<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Modelo para el inventario
class Inventario extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'image'];
}

