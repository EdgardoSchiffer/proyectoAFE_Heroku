@extends('layouts.app')
@section('content')
<div id="app">
   <index-rental :data_user="{{Auth::user() != null ? Auth::user() :'null'}}"></index-rental>
</div>
@endsection