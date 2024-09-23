<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeknisiDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Teknisi
    public function index(){
        return view('teknisi.dashboard');
    }
}
