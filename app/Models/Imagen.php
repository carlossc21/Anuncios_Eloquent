<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    
    protected $table = 'imagen';
    public $timestamps = false;
    protected $fillable = ['idanuncio', 'nombre', 'descripcion'];
    
     function anuncio(){
        return $this->belongsTo('App\Models\Anuncio', 'idanuncio');
    }
}
