<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Super
    public function index(){
        return view('super.dashboard');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('super.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('super.profile')->with('success', 'Profile updated successfully');
    }
}
