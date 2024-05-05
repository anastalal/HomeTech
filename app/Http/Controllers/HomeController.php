<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plans = Auth::user()->plans;
        return view('home' , compact("plans"));
    }
    public function plans()
    {
        $plans = Plan::all()->sortByDesc('created_at');
        return view('welcome' , compact("plans"));
    }
}
