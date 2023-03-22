<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Sexo;

use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::orderBy('id_autor','DESC')->paginate(10);
        return view('autores.index',['autores' => $autores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexos = Sexo::all();
        return view('autores.create',['sexos'=> $sexos]);
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
            'nombres' => 'required|min:3|max:100',
            'apellidos' => 'required|min:3|max:100',
            //'id_sexo' => 'required'
        ]); 

        $request['nombrecompleto'] = $request->nombres.' '.$request->apellidos;

        Autor::create($request->all());

        return redirect()->route('autores.index')->with('success','Autor Registrado Correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        return view('autores.show',['autor' => $autor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        $sexos = Sexo::all();
        return view('autores.edit',['autor'=> $autor,'sexos'=> $sexos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nombres' => 'required|min:3|max:100',
            'apellidos' => 'required|min:3|max:100',
        ]);
        
        $autor->fill($request->only([
            'nombres',
            'apellidos',
            'id_sexo'
        ]));

        if($autor->isClean()){
            return back()->with('warning','Debe realizar al menos un cambio para actualizar.');
        }

        $autor->update($request->all());

        return back()->with('success','Autor Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();
        return back()->with('danger','Autor Eliminado Correctamente.');
    }
}
