<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = UserRequest::where('user_id', Auth::id())
                    ->whereNotIn('status', ['Done', 'Canceled', 'Rejected'])
                    ->orderBy('request_date', 'desc');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('no_bpj', 'LIKE', "%{$searchTerm}%")
                ->orWhere('deskripsi_permasalahan', 'LIKE', "%{$searchTerm}%");
            });
        }

        $recentRequests = $query->take(10)->get();

        return view('user.dashboard', compact('recentRequests'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

}

