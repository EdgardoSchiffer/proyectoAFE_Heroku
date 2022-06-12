@extends('layouts.app')
@section('content')
<div id="app">
   <vehicle-dashboard :data_user="{{Auth::user() != null ? Auth::user() :'null'}}"></vehicle-dashboard>
</div>
@endsection