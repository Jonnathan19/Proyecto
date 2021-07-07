@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" >
                    <h2>Nuevo sensor</h2>
                </div>
                 <div class='card-body'>
                     <form action="/sensors" method="POST">
                        @csrf
                        <div class="mb-3">
                             <label for="" class="form-label">Nombre</label>
                             <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="mb-3">
                             <label for="" class="form-label">Ubicación</label>
                             <input type="text" name="location" class="form-control" >
                        </div>
                        <div class="mb-3">
                             <label for="" class="form-label">Descripción</label>
                             <textarea type="text" name="description" class="form-control" > </textarea>
                        </div>
                        <button type='submit' class='btn btn-success'>Confirmar</button>
                        <a href="/sensors" class="btn btn-danger" >Cancelar</a>
                     </form>                                   
                 </div> 
            </div>
        </div>
    </div>
</div>
@endsection