<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;
    
    protected $table = 'anuncio';
    protected $fillable = ['titulo', 'descripcion', 'telefono', 'correo', 'localidad', 'precio', 'nombre'];
    
    function imagenes(){
        return $this->hasMany('App\Models\Imagen', 'idanuncio');
    }
}
