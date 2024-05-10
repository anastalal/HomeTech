<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    
    public function index(){
        // Retrieve the currently authenticated user and get all their plans
        $plans = Auth::user()->plans;
        // Display the plans in the home page
        return view('home' , compact("plans"));
    }

    public function plans(){
        // Retrieve all plans from the database, sorted in descending order based on the 'created_at' time
        $plans = Plan::all()->sortByDesc('created_at');
        // Display all plans in the plans page
        return view('plans' , compact("plans"));
    }
}