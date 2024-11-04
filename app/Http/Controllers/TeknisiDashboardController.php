<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Teknisi
    public function index(){
        return view('teknisi.dashboard');
    }
    
    public function profile()
    {
        $user = Auth::user();
        return view('teknisi.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('teknisi.profile')->with('success', 'Profile updated successfully');
    }
}
