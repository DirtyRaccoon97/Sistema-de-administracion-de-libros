@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-md-12">
        <div class="pull-right">
            <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Inicio" href="{{ route('autores.index') }}"> 
                <i class="fa fa-home fa-fw"></i> 
            </a>
        </div>
    </div>
    <div class="col-md-12">
        <form  action="{{ route('autores.update', $autor) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control shadow-none" id="nombres" name="nombres" value="{{ old('nombres',$autor->nombres) }}">
            @error('nombres')
                <small class="text-danger" role="alert">
                    {{ $message }}
                </small>
            @enderror
            </div>
            <div class="col-md-6">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control shadow-none" id="apellidos" name="apellidos" value="{{ old('apellidos',$autor->apellidos) }}">
            @error('apellidos')
                <small class="text-danger" role="alert">
                    {{ $message }}
                </small>
            @enderror
            </div>
            <div class="col-md-6">
            <label for="sexo" class="form-label">Sexo</label>
            <select id="sexo" class="form-select shadow-none" name="cod_sexo" value="{{ old('cod_sexo') }}">
                <option value="">Seleccionar...</option>
                @foreach ($sexos as $sexo)
                    <option value="{{$sexo->cod_sexo}}" {{ ($autor->cod_sexo == $sexo->cod_sexo) ? 'selected' : '' }}>{{ $sexo->descripcion }} </option>
                @endforeach
            </select>
            @error('cod_sexo')
                <small class="text-danger" role="alert">
                    Seleccione un Sexo
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