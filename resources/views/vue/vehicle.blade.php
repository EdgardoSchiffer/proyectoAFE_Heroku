@extends('layouts.app')
@section('content')
<div id="app">
   <index-vehicle :data_user="{{Auth::user() != null ? Auth::user() :'null'}}"></index-vehicle>
</div>
@endsection