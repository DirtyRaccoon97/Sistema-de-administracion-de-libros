@extends('layouts.app')

@section('content')
    <div class="cointainer">
        <div class="row">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
            </div>
            @endif

            <div class="col-md-12">
                <div class="pull-right">
                    <a class="btn btn-primary shadow-none" data-toggle="tooltip" data-placement="top" title="Agregar libros" href="{{ route('libros.create')}}"> 
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-12">
                @if(sizeof($libros)> 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Acciones</th>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha de Publicacion</th>
                            <th scope="col">Idioma</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($libros as $libro)
                            <tr>
                                <td class="text-center" width="20%">
                                    <a href="{{ route('libros.show',$libro)}}" class="btn btn-primary btn-sm shadow-none" 
                                            data-toggle="tooltip" data-placement="top" title="Ver Libro">
                                        <i class="fa fa-book fa-fw text-white"></i></a>
                                    </a>
                                    <a href="{{ route('libros.edit',$libro)}}" class="btn btn-success btn-sm shadow-none" 
                                            data-toggle="tooltip" data-placement="top" title="Editar Libro">
                                        <i class="fa fa-pencil fa-fw text-white"></i></a>
                                    </a>
                                    <form action="{{ route('libros.destroy',$libro) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete" name="delete" type="submit" 
                                                class="btn btn-danger btn-sm shadow-none" 
                                                data-toggle="tooltip" data-placement="top" title="Eliminar Libro"
                                                onclick="return confirm('¿Estás seguro de eliminar?')">
                                            <i class="fa fa-trash-o fa-fw"></i>
                                        </button>
                                    </form>
                                </td>
                                <td scope="row">{{ $libro->id_libro }}</td>
                                <td scope="row">{{ $libro->titulo}}</td>
                                <td scope="row">{{ $libro->descripcion}}</td>
                                <td scope="row">{{ date('d/m/y',strtotime($libro->fecha_publicacion)) }}</td>
                                <td scope="row">{{ 
                                    ($libro->id_idioma) ? $libro->idioma->descripcion : 'No se asigno idioma'
                                }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $libros->links() !!}
                </div>
            </div>
            @else
                <div class="alert alert-secondary">No se encontraron resultados.</div>
            @endif
        </div>
    </div>
@endsection