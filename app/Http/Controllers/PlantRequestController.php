<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class PlantRequestController extends Controller
{
    public function index() // Ini buat nampilin list request non-urgent
    {
        $plantsRequests = UserRequest::where([
            ['status', '=', 'plants'],
            ['jenis', '=', 'non-urgent']
        ])->get();

        return view('plant.requests.index', compact('plantsRequests'));
    }  

    public function updateStatus(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:accept,reject',
        ]);

        // Update status berdasarkan pilihan accept/reject
        $newStatus = $validatedData['status'] === 'accept' ? 'admins' : 'rejected';

        // Update status saja
        $userRequest->update([
            'status' => $newStatus
        ]);

        $message = $newStatus === 'admins' ? 'Request diterima dan diteruskan ke admin.' : 'Request ditolak.';
        return redirect()->route('plant.requests.index')->with('success', $message);
    }

    public function show(UserRequest $request)
    {
        return view('plant.requests.show', compact('request'));
    }
}
