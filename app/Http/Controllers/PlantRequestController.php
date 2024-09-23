<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class PlantRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('jenis', 'non-urgent')->where('status', 'pending')->get();
        return view('plant.requests.index', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        return view('plant.requests.show', compact('request'));
    }

    public function approve(UserRequest $request)
    {
        $request->status = 'ongoing';
        $request->save();
        // Kirim notifikasi ke Admin
        return redirect()->route('plant.requests.index')->with('success', 'Request disetujui.');
    }

    public function reject(UserRequest $request)
    {
        $request->status = 'rejected';
        $request->save();
        // Kirim notifikasi ke Userw
        return redirect()->route('plant.requests.index')->with('success', 'Request ditolak.');
    }
}
