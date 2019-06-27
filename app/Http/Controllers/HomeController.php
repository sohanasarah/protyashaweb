<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function depot(){
        return view('depot.dashboard');
    }

    public function division(){
        return view('division.dashboard');
    }

    public function marketing(){
        return view('marketing.dashboard');
    }

    public function admin(){
        return view('admin.dashboard');
    }
}
