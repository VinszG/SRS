<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantDashboardController extends Controller
{
    public function index()
    {
        // Get ongoing requests with non-urgent type
        $ongoingRequests = UserRequest::where([
            ['status', '=', 'ongoing'],
            ['jenis', '=', 'non-urgent']
        ])->orderBy('created_at', 'desc')->get();

        return view('plant.dashboard', compact('ongoingRequests'));
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
    