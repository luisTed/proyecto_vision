<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultas extends Model
{
// Especifica la clave primaria de la tabla
protected $primaryKey = 'id';

// Desactiva las marcas de tiempo automáticas (created_at y updated_at)
public $timestamps = false;

// Reglas de validación estáticas para el modelo
static $rules = [
    'nombre' => 'required',
    'fecha' => 'required',
    'hora' => 'required',
];

// Especifica los campos que se pueden asignar masivamente (Mass Assignment)
protected $fillable = ['id', 'nombre', 'fecha', 'hora', 'contacto', 'descripccion'];

// Importa la trait HasFactory
use HasFactory;

}
