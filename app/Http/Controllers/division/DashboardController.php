<?php

namespace App\Http\Controllers\division;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('division.dashboard');
    }

    public function orders()
    {
        $orders =  DB::table('orders');
        $orders->select(DB::raw('orders.order_nbr, orders.order_date, orders.order_status, orders.cust_id, orders.site_code, order_lines.line_id, order_lines.item_code, order_lines.line_nbr, order_lines.line_qty_ord, order_lines.line_qty_ship, order_lines.line_status'))
            ->leftJoin('order_lines', 'orders.order_nbr', '=', 'order_lines.order_nbr')
            ->leftJoin('sites', 'orders.site_code', '=', 'sites.site_code')
            ->where('site_division', '=', session('user_name'));
        $orders =  $orders->get();

        return view('division.reports.orders')->with('orders', $orders);
    }

    public function close_orders(Request $request)
    {
        //dd($request->all());
        $id = $request->id;
        $status = "cancelled";
        $update =  DB::table('order_lines')
            ->where('line_id', '=', $id)
            ->update(['line_status' => $status]);
        if ($update) {
            return response()->json('Status Has Been Updated');
        } else {
            return response()->json('Failed!');
        }
    }

    public function items()
    {
        $items =  DB::table('items')
            ->where('status', '=', "active")
            ->get();

        return view('division.reports.items')->with('items', $items);
    }
}
