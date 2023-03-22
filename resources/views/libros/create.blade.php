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

            <form  action="{{ route('libros.store') }}" method="POST" class="row g-3">
              @csrf
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título de Libro</label>
                <input type="text" class="form-control shadow-none" id="titulo" name="titulo" value="{{ old('titulo') }}">
                @error('titulo')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
              </div>
                  <div class="col-md-6">
                    <label for="idioma" class="form-label">Idioma</label>
                    <select id="idioma" class="form-select shadow-none" name="id_idioma" value="{{ old('idioma') }}">
                      <option value="" selected>Seleccionar...</option>
                      @foreach ($idiomas as $idioma)
                            <option value="{{$idioma->id_idioma}}" {{ old('idioma') == $idioma->id_idioma ? 'selected' : '' }}>{{$idioma->descripcion}} </option>
                      @endforeach
                    </select>
                    @error('id_idioma')
                        <small class="text-danger" role="alert">
                            Seleccione el Idioma
                        </small>
                    @enderror
                    </div>
                    <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción de Libro</label>
                    <textarea class="form-control shadow-none" name="descripcion" id="descripcion" cols="30" rows="5" value="">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <small class="text-danger" role="alert">
                            {{ $message }}
                        </small>
                    @enderror
                    </div>
                    <div class="col-md-6">
                    <label for="fecha_publicacion" class="form-label">Fecha de Publicación</label>
                    <input class="form-control shadow-none" type="date" name="fecha_publicacion" value="{{old('fecha_publicacion')}}"/>
                    @error('fecha_publicacion')
                        <small class="text-danger" role="alert">
                            {{ $message }}
                        </small>
                    @enderror
                    </div>
                    <div class="col-md-6">
                    <label for="categorias" class="form-label">Categorías</label><br>
                        @if(sizeof($categorias) > 0)
                        @foreach ($categorias as $id_categoria => $titulo)
                            <input type="checkbox" 
                            value="{{ $id_categoria }}" 
                            name="categorias[]" 
                            {{ ( is_array(old('categorias') ) && in_array($id_categoria, old('categorias')) ) ? 'checked ' : '' }}>
                            {{ $titulo }}
                        @endforeach
                <br>
                @error('categorias')
                    <small class="text-danger" role="alert">
                        {{ $message }}
                    </small>
                @enderror
                    @else
                    <div class="alert alert-secondary">No se encontraron resultados.</div>
                    @error('categorias')
                        <small class="text-danger" role="alert">
                            {{ $message }}
                        </small>
                    @enderror
                @endif
    </div>
    <div class="col-md-6">
      <label for="autores" class="form-label">Autores</label><br>
        @if(sizeof($autores) > 0)
        @foreach ($autores as $id_autor => $nombrecompleto)
            <input type="checkbox" value="{{ $id_autor }}" name="autores[]" 
            {{ ( is_array(old('autores') ) && in_array($id_autor, old('autores')) ) ? 'checked ' : '' }}>
            {{ $nombrecompleto }}
        @endforeach
        <br>
        @error('autores')
            <small class="text-danger" role="alert">
                {{ $message }}
            </small>
        @enderror
        @else
          <div class="alert alert-secondary">No se encontraron resultados.</div>
          @error('autores')
            <small class="text-danger" role="alert">
                {{ $message }}
            </small>
        @enderror
      @endif
    </div>


              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>

        </div>
    </div>
</div>
@endsection