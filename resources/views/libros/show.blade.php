@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('libros.index') }}"> 
                    <i class="fa fa-home fa-fw"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mx-auto" style="width: 50%;">
              <div class="card-header">
                Libro
              </div>
              <div class="card-body text-center">
                <h5 class="card-title"><b>{{$libro->titulo}}</b></h5>
                <p class="card-text">{{ $libro->descripcion }}<br>
                <b>{{ ($libro->id_idioma) ? $libro->idioma->descripcion : 'No se asigno idioma'}}</p>
              </div>
              <div class="card-footer text-muted text-center">
               
                {{ date('d/m/y',strtotime($libro->fecha_publicacion)) }}
              </div>
            </div>
        </div>
    </div>
</div>

@endsection