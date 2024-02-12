<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trabajadores extends Model
{
// Especifica el nombre de la tabla en la base de datos asociada al modelo
protected $table = 'trabajadores';

// Especifica la clave primaria de la tabla
protected $primaryKey = 'ID_trabajo';

// Desactiva las marcas de tiempo automáticas (created_at y updated_at)
public $timestamps = false;

// Importa la trait HasFactory
use HasFactory;

}
