@extends('layouts.app')
@section('content')
<div id="app">
   <index-rental-user :data_user="{{Auth::user() != null ? Auth::user() :'null'}}"></index-rental-user>
</div>
@endsection