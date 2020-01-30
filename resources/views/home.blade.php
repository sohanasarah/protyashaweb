@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if (Auth::check())
    <p>You are logged in! {{ session('user_name'). session('user_role') }}</p>
    @endif
@stop

@section('footer')
@endsection
