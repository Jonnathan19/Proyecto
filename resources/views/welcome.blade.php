@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido') }}</div>

                <div class="card-body">
                    {{ __('Esta es una aplicación en tiempo real') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
