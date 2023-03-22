<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Idioma;
use App\Models\Autor;
use App\Models\Categoria;


use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::orderBy('id_libro','DESC')->paginate(10);
        return view('libros.index',['libros' => $libros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idiomas = Idioma::all();
        $categorias = Categoria::pluck('titulo','id_categoria');
        $autores = Autor::pluck('nombrecompleto','id_autor');
        
     

        return view('libros.create',['idiomas'=> $idiomas,'categorias' => $categorias, 'autores' => $autores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_libro',
            'descripcion' => 'required|min:3|max:200',
            'fecha_publicacion' => 'required|date',
            'categorias' => 'required',
            'autores' => 'required'
        ]); 


        $libro = Libro::create($request->all());

        $libro->categoria()->sync($request->categorias);
        $libro->autores()->sync($request->autores);

        return redirect()->route('libros.index')
                        ->with('success','Libro Registrado Correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return view('libros.show',['libro' => $libro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        $categorias = Categoria::pluck('titulo','id_categoria');
        $autores = Autor::pluck('nombrecompleto','id_autor');
        $idiomas = Idioma::all();
        return view('libros.edit',['idiomas'=> $idiomas,'libro'=> $libro ,'categorias' => $categorias, 'autores' => $autores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_libro,titulo,'.$libro->id_libro.',id_libro',
            'descripcion' => 'required|min:3|max:200',
            'fecha_publicacion' => 'required|date',
            'categorias'=> 'required',
            'autores'=> 'required'
        ]); 
        
        $libro->fill($request->only([
            'titulo',
            'descripcion',
            'fecha_publicacion',
            'id_idioma'
        ]));

        if($libro->isClean()){
            return back()->with('warning','Debe realizar al menos un cambio para actualizar.');
        }

        $libro->update($request->all());

        $libro->categorias()->sync($request->categorias);
        $libro->autores()->sync($request->autores);

        return back()->with('success','Libro Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return back()->with('danger','Autor Eliminado Correctamente.');
    }
}
