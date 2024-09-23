<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Super
    public function index(){
        return view('super.dashboard');
    }
}
