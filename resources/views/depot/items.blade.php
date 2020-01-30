@extends('layouts.app')

@section('content_header')
<h1>Orders List</h1>
@stop

@section('content')
@if (Auth::check())
<div class="table-responsive">
    <table id="data-table" width="100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Product Line</th>
                <th>Category</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @if(count($items)>0)
            @foreach ($items as $item)
            @php
            $category_details = Helper::get_brand_details($item->category);
            $item_details = Helper::get_item_details($item->item_code);
            @endphp
            <tr>
                <td>{{$item->item_code}}</td>
                <td>{{$item->item_name}}</td>
                <td>{{$item->prod_line}}</td>
                <td>{{$category_details->code_cmmt}}</td>
                <td>{{$item->item_code}}</td>
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
            paging: true,
            pagelength: 20,
            dom: 'Blfrtip',
            buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                'csv',
                'copy',
                'print'
                ]
            }
            ]
        });
    })
</script>
@stop
