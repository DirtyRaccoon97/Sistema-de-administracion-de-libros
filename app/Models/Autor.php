<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'lib_autor'; //indica la tabla
    protected $primaryKey = 'id_autor'; //indica el primary key
    protected $fillable =['nombres','apellidos','nombrecompleto','id_sexo']; // trae parametros de datos

    public $timestamps = false;

    public function sexo()
    {
        return $this->belongsTo(Sexo::class,'id_sexo','id_sexo');
    }

    public function libros()
    {
        return $this->belongsToMany(Libro::class,'lib_asignar_autores','id_autor','id_libro');
    }

}
