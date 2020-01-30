@extends('layouts.app')

@section('content_header')
<h1>Depot Dashboard</h1>
@stop

@section('content')
@if (Auth::check())
<p>You are logged in! {{ session('user_name') ." ".  session('user_role') }}</p>

@endif
@stop
