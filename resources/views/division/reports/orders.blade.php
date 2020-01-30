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
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($orders)>0)
            @foreach ($orders as $order)
            @php
            $cust_details = Helper::get_customer_details($order->cust_id);
            $item_details = Helper::get_item_details($order->item_code);
            @endphp
            <tr>
                <td>{{$order->order_nbr}}</td>
                <td>{{$order->order_date}}</td>
                <td>{{$cust_details->cust_name}}</td>
                <td>{{$order->site_code}}</td>
                <td>{{$order->line_nbr}}</td>
                <td>{{$order->item_code}}</td>
                <td>{{$item_details->item_name }}</td>
                <td>{{$order->line_qty_ord}}</td>
                <td>{{$order->line_qty_ship}}</td>
                <td class="status">{{ucfirst($order->line_status)}}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-block subbtn"
                        onclick="close_order('{{$order->line_id}}')">Cancel</button>
                </td>
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
    function close_order(data){
        if(confirm('Are You Sure You Want to Cancel?')){
            $.ajax({
            url:"{{ url('/division/order_list/{id}') }}",
            method:"GET",
            data:{ id : data },
            success: function( data )
            {
                alert(data);
                location.reload();
            },
            error: function(data) { // if error occured
                alert("Error occured, please try again");
            },
            });
        }

    }

    $(document).ready(function () {

        $('table tr').each(function(i) {
           var status = $(this).find('.status').html();
           if(status === "Cancelled"){
               $(this).find('.subbtn').attr('disabled', 'disabled');
           }
           else{
               $(this).find('.subbtn').removeAttr('disabled');;
           }
        });

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
