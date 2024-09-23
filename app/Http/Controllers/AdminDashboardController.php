<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Admin
    public function index(){
        return view('admin.dashboard');
    }
}
