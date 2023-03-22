<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    use HasFactory;

    protected $table = 'lib_sexo'; //indica la tabla
    protected $primaryKey = 'id_sexo'; //indica el primary key
    protected $fillable =['descripcion']; // trae parametros de datos

    public $timestamps = false;



    public function sexo()
    {
        return $this->hasMany(Autor::class,'id_sexo','id_sexo');
    }
}
