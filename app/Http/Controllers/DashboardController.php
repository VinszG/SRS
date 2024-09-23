<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $recentRequests = UserRequest::where('user_id', Auth::id())
                             ->orderBy('request_date', 'desc')
                             ->get();

        return view('user.dashboard', compact('recentRequests'));
    }
}

