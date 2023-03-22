<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\Request;

class SexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sexos = Sexo::orderBy('id_sexo','DESC')->paginate(5);
        return view('sexos.index',['sexos'=> $sexos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sexos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //para guardar
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo'
        ]);

        Sexo::create($request->all());

        return redirect()
                ->route('sexos.index')
                ->with('success','Sexo Registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function show(Sexo $sexo)
    {
        return view('sexos.show', ['sexo' => $sexo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Sexo $sexo)
    {
        return view('sexos.edit', ['sexo' => $sexo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sexo $sexo)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo,descripcion,'.$sexo->id_sexo.',id_sexo'
        ]);

        $sexo->fill($request->only([
            'descripcion'
        ]));

        if($sexo->isClean()){
            return back()->with('mensajedeadvertencia','Debe realizar al menos un cambio para actualizar.');
        }
        
        
        $sexo->update($request->all());


        return back()->with('mensajedeexito','Sexo actualizado correctamente.');;

        //return redirect()->route('sexos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sexo  $sexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sexo $sexo)
    {
        $sexo->delete();
        return back();
    }
}
