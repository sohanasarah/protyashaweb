@extends('layouts.app')

@section('content_header')
<h1>Orders List</h1>
@stop

@section('content')
@if (Auth::check())
<div class="table-responsive table-bordered {{'datatable'}}">
    <table id="data-table" width="100%" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Site</th>
                <th>Line</th>
                <th>Item</th>
                <th>Item Desc</th>
                <th>Qty Ordered</th>
                <th>Qty Shipped</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($depot_orders)>0)
            @foreach ($depot_orders as $orders)
            @php
            $cust_details = Helper::get_customer_details($orders->cust_id);
            $item_details = Helper::get_item_details($orders->item_code);
            @endphp
            <tr>
                <td>{{$orders->order_nbr}}</td>
                <td>{{$orders->order_date}}</td>
                <td>{{$cust_details->cust_name}}</td>
                <td>{{$orders->site_code}}</td>
                <td>{{$orders->line_nbr}}</td>
                <td>{{$orders->item_code}}</td>
                <td>{{$item_details->item_name }}</td>
                <td>{{$orders->line_qty_ord}}</td>
                <td>{{$orders->line_qty_ship}}</td>
                <td>{{$orders->order_status}}</td>
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
