<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen_insumos extends Model
{
// Especifica el nombre de la tabla en la base de datos asociada al modelo
protected $table = 'almacen_insumos';

// Especifica la clave primaria de la tabla
protected $primaryKey = 'id_insumo';

// Desactiva las marcas de tiempo automáticas (created_at y updated_at)
public $timestamps = false;

// Importa la trait HasFactory
use HasFactory;

}
