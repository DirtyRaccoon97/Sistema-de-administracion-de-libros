@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
    @if(session('mensajedeadvertencia'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('mensajedeadvertencia') }}
            </div>
    @endif

    @if(session('mensajedeexito'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensajedeexito') }}
            </div>
    @endif
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('idiomas.index') }}"> 
                    <i class="fa fa-home fa-fw"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <form  action="{{ route('idiomas.update',$idioma)}}" method="POST" class="row g-3">
                @csrf 
                @method('PUT')
                <div class="col-md-6">
                <label for="descripcion" class="form-label">Descripción de idioma</label>
                <input type="text" class="form-control shadow-none" id="descripcion" name="descripcion" value="{{ old('descripcion', $idioma->descripcion ) }}">
                @error('descripcion')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
                </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            </form>

        </div>
    </div>
</div>

@endsection