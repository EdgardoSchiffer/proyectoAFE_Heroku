@extends('layouts.app')
{{--@extends('errors::minimal')--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Error') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong>{{ __('Estimado usuario, no posee acceso para ver esta pagina. Por favor inicie sesión.') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
