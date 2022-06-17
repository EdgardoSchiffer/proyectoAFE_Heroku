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

                    <strong>{{ __('La página solicitada no existe.') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
