<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'lib_categoria'; //indica la tabla
    protected $primaryKey = 'id_categoria'; //indica el primary key
    protected $fillable =['titulo']; // trae parametros de datos

    public $timestamps = false;

    public function libros()
    {
        return $this->belongsToMany(Libros::class,'lib_asignar_categorias','id_categoria','id_libro');
    }



}
