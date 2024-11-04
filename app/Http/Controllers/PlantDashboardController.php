<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Plant
    public function index(){
        return view('plant.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('plant.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('plant.profile')->with('success', 'Profile updated successfully');
    }
}
