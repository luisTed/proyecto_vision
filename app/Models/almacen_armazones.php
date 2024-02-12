<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen_armazones extends Model
{
// Importa la trait HasFactory
use HasFactory;

// Especifica el nombre de la tabla en la base de datos asociada al modelo
protected $table = 'almacen_armazones';

// Especifica la clave primaria de la tabla
protected $primaryKey = 'id_armazon';

// Desactiva las marcas de tiempo automáticas (created_at y updated_at)
public $timestamps = false;

// Especifica los campos que se pueden asignar masivamente (Mass Assignment)
protected $fillable = [
    'proveedor',
    'marca_proveedor',
    'modelo_proveedor',
    'tamaño', 
    'codigo_barras',
    'tipo',
    'precio',
    'id_armazon'
];

}
