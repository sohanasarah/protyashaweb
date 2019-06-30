@extends('adminlte::page')

@section('title', 'Prostyasha Web')

@section('content_header')
<h1>Depot Dashboard</h1>
@stop

@section('content')
@if (Auth::check())
<p>You are logged in! {{ session('user_name') ." ".  session('user_role') }}</p>
<div class="table-responsive">
    <table id="data-table" width="100%" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Site</th>
                <th>Item</th>
                <th>Line</th>
                <th>Qty Ordered</th>
                <th>Qty Shipped</th>
            </tr>
        </thead>
        <tbody>
            {!! Library::bob('Sarah') !!}
            @if(count($depot_orders)>0)
            @foreach ($depot_orders as $orders)
            <tr>
                <td>{{$orders->order_nbr}}</td>
                <td>{{$orders->order_date}}</td>
                <td>{{$orders->cust_id}}</td>
                <td>{{$orders->site_code}}</td>
                <td>{{$orders->item_code}}</td>
                <td>{{$orders->line_nbr}}</td>
                <td>{{$orders->line_qty_ord}}</td>
                <td>{{$orders->line_qty_ship}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endif
@stop

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#data-table').dataTable({
            paging: false,
            dom: 'Blfrtip',
            buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                'copy',
                'excel',
                'csv'
                ]
            }
            ]
        });
    })
</script>
@stop
