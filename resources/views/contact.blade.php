@extends('layout')

@section('content')
<h1>Contact</h1>

@can('home.secret', Model::class)
<p>Special contact detials</p>
@endcan
@endsection