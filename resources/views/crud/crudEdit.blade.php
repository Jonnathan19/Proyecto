@extends('layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" >
                    <h2>{{ $sensor->name }}</h2>
                </div>
                 <div class='card-body'>
                     <form action="{{route('sensors.update', $sensor->name)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Sede</label>
                            <input type="text" name="campus" class="form-control" value="{{$sensor->campus}}">
                       </div>
                        <div class="mb-3">
                             <label for="" class="form-label">Ubicación</label>
                             <input type="text" name="location" class="form-control" value="{{$sensor->location}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tipo de sensor</label>
                            <select name="type" class="form-control">
                                <option value="Temperatura" @if($sensor->type=== "Temperatura") selected='selected' @endif>Temperatura</option>
                                <option value="Humedad" @if($sensor->type=== "Humedad") selected='selected' @endif>Humedad</option>
                                <option value="CO2" @if($sensor->type=== "CO2") selected='selected' @endif>CO2</option>
                            </select>
                       </div>
                        <div class="mb-3">
                             <label for="" class="form-label">Descripción</label>
                             <textarea type="text" name="description" class="form-control"> "{{$sensor->description}}" </textarea>
                        </div>

                        <button type='submit' class='btn btn-success'>Confirmar</button>
                        <a href="/Proyect/public/sense" class="btn btn-danger" >Cancelar</a>
                     </form>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
