@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">      
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Sensores activos</h2>
                </div>
                <div class="card-body table-responsive">                             
                    <a href="sensors/create" class="btn btn-primary">Crear</a>
                    <table class="table table-striped mt-6 text-white">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Botones</th>            
                            </tr>
                            <tbody class='table text-black'>
                                @foreach ($sensors as $sensor)
                                    <tr>
                                        <td>{{ $sensor->id}}</td>
                                        <td>{{ $sensor->name}}</td>
                                        <td>{{ $sensor->location}}</td> 
                                        <td>
                                            <form action="{{route('sensors.destroy', $sensor->id)}}" method="POST">
                                                <a href="historic/{{$sensor->id}}/show" class="btn btn-success">Ver</a>
                                                <a href="sensors/{{$sensor->id}}/edit" class="btn btn-info">Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class="btn btn-danger">Borrar</button>
                                            </form>
                                        </td>                                                 
                                    </tr>                         
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection