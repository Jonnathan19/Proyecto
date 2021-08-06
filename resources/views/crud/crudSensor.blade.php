@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-white bg-info">
                    <h2>Sensores activos</h2>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped mt-8 text-white text-center">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col-2">Nombre</th>
                                <th scope="col">Sede</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Medición</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            <tbody class='table text-black text-center'>
                                @foreach ($sensors->unique('name') as $sensor)
                                    <tr>
                                        <td>{{ $sensor->name}}</td>
                                        <td>{{ $sensor->campus}}</td>
                                        <td>{{ $sensor->location}}</td>
                                        <td>{{ $sensor->description}}</td>
                                        <td>
                                            @if ($sensor->type == 'Temperatura')
                                                {{ $sensors->where('name',$sensor->name)->last()->val}} °C

                                            @elseif ($sensor->type == 'Humedad')
                                                {{ $sensors->where('name',$sensor->name)->last()->val}} %
                                            @else
                                                {{ $sensors->where('name',$sensor->name)->last()->val}} ppm
                                            @endif

                                        </td>
                                        <td>
                                            <input type ='button' class="btn btn-success btn-sm"  value = 'Ver' onclick="location.href = '{{route('id', $sensor->name)}}'"/>
                                        </td>
                                        <td>
                                            <a href="sensors/{{$sensor->id}}/edit" class="btn btn-info text-white btn-sm">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{route('sensors.destroy', $sensor->name)}}" method="POST" class="form-responsive">
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
