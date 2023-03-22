<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    protected $table = 'lib_idioma'; //indica la tabla
    protected $primaryKey = 'id_idioma'; //indica el primary key
    protected $fillable =['descripcion']; // trae parametros de datos

    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany(Libro::class,'id_libro','id_libro');
    }

}
