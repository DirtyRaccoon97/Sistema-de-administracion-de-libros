<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idiomas = Idioma::orderBy('id_idioma','DESC')->paginate(5);
        return view('idiomas.index',['idiomas'=> $idiomas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idiomas.create');
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
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma'
        ]);

        Idioma::create($request->all());

        return redirect()
                ->route('idiomas.index')
                ->with('success','Idioma Registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function show(Idioma $idioma)
    {
        return view('idiomas.show', ['idioma' => $idioma]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function edit(Idioma $idioma)
    {
        return view('idiomas.edit', ['idioma' => $idioma]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idioma $idioma)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma,descripcion,'.$idioma->id_idioma.',id_idioma'
        ]);

        $idioma->fill($request->only([
            'descripcion'
        ]));

        if($idioma->isClean()){
            return back()->with('mensajedeadvertencia','Debe realizar al menos un cambio para actualizar.');
        }
        
        
        $idioma->update($request->all());


        return back()->with('mensajedeexito','Idioma actualizado correctamente.');;

        //return redirect()->route('idioma.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();
        return back()->with('danger','Idioma Eliminado Correctamente.');
    }
}
