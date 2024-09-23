<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Plant
    public function index(){
        return view('plant.dashboard');
    }
}
