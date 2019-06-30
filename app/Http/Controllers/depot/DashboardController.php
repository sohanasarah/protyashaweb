<?php

namespace App\Http\Controllers\depot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $depot_orders =  DB::table('orders');
        $depot_orders  ->select( DB::raw('orders.order_nbr, order_date, cust_id, site_code, item_code, line_nbr, line_qty_ord, line_qty_ship '))
                ->leftJoin('order_lines', 'orders.order_nbr', '=', 'order_lines.order_nbr')
                ->where('site_code','=', session('user_name'));
        $depot_orders=  $depot_orders->get();

        return view('depot.dashboard')->with('depot_orders', $depot_orders);;
    }
}