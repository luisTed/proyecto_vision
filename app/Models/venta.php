<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    protected $table='venta';
    protected $primaryKey='id_venta';

    public $timestamps=false;
    use HasFactory;
}
