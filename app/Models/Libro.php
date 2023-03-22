<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'lib_libro'; //indica la tabla
    protected $primaryKey = 'id_libro'; //indica el primary key
    protected $fillable =['titulo','descripcion','fecha_publicacion','id_idioma']; // trae parametros de datos

    public $timestamps = false;

    public function idioma()
    {
        return $this->belongsTo(Idioma::class,'id_idioma','id_idioma');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class,'lib_asignar_categorias','id_libro','id_categoria');
    }


    public function autores()
    {
        return $this->belongsToMany(Autor::class,'lib_asignar_autores','id_libro','id_autor');
    }

}
