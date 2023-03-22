@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('autores.index') }}"> 
                    <i class="fa fa-home fa-fw"></i> 
                </a>
            </div>
        </div>
        <div class="col-md-12">

            <form  action="{{ route('autores.store') }}" method="POST" class="row g-3">
              @csrf
              <div class="col-md-6">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control shadow-none" id="nombres" name="nombres" value="{{ old('nombres') }}">
                @error('nombres')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control shadow-none" id="apellidos" name="apellidos" value="{{ old('apellidos') }}">
                @error('apellidos')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="sexo" class="form-label">Sexo</label>
                <select id="sexo" class="form-select shadow-none" name="id_sexo" value="{{ old('id_sexo')}}">
                  <option value="" selected>Seleccionar...</option>
                  @foreach($sexos as $sexo)
                    <option value="{{ $sexo->id_sexo }}">{{$sexo->descripcion}}</option>
                  @endforeach
                </select>
                @error('cod_sexo')
                    <small class="text-danger" role="alert">
                        Seleccione un Sexo
                    </small>
                @enderror
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>

        </div>
    </div>
</div>
@endsection