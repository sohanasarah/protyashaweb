@extends('adminlte::page')

@section('title', 'Prostyasha Web')

@section('content_header')
<h1>Division Dashboard</h1>
@stop

@section('content')
@if (Auth::check())
<p>You are logged in! {{ session('user_name'). session('user_role') }}</p>
<div class="table-responsive">
    <table id="myTable" width="100%" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
                <th>Header</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@endif
@stop
