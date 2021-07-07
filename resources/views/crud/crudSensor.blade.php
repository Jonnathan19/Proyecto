@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">      
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Sensores activos</h2>
                </div>
                <div class="card-body table-responsive">                             
                    <table class="table table-striped mt-8 text-white text-center">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">Nombre</th>
                                <th scope="col">Sede</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Botones</th>            
                            </tr>
                            <tbody class='table text-black text-center'>    
                                @foreach ($sensors->unique('name') as $sensor)                                     
                                    <tr>
                                        
                                        <td>{{ $sensor->name}}</td>
                                        <td>{{ $sensor->campus}}</td> 
                                        <td>{{ $sensor->location}}</td> 
                                        <td>{{ $sensor->description}}</td> 
                                        <td>
                                            <form action="{{route('sensors.destroy', $sensor->id)}}" method="POST">
                                                <input type ='button' class="btn btn-success btn-sm"  value = 'Ver' onclick="location.href = '{{route('id', $sensor->name)}}'"/>
                                                <a href="sensors/{{$sensor->id}}/edit" class="btn btn-info text-white btn-sm">Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type='submit' class="btn btn-danger btn-sm">Borrar</button>
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