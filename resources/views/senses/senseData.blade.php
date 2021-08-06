@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header align-center" >Sense</div>
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <input type="text" name="val" placeholder="Temperatura"><br>
                        <input type="text" name="event" placeholder="evento"><br>
                        <input type="date" name="date" placeholder="Fecha y hora"><br>
                        <button>Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
