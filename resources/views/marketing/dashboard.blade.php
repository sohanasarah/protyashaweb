@extends('adminlte::page')

@section('title', 'Prostyasha Web')

@section('content_header')
<h1>Marketing Dashboard</h1>
@stop

@section('content')
@if (Auth::check())
<p>You are logged in! {{ session('user_name'). session('user_role') }}</p>

@endif
@stop
