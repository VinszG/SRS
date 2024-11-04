<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class SuperRequestController extends Controller
{
    public function index()
    {
        // Mengambil request dengan status 'spv' dan jenis 'supervisor'
        $requests = UserRequest::where([
            ['status', '=', 'spv'],
            ['jenis', '=', 'supervisor']
        ])
        ->orderBy('request_date', 'desc')
        ->paginate(10);

        // Pastikan view menerima variable $requests
        return view('super.dashboard', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        return view('super.request.show', compact('request'));
    }   

    public function updateJenis(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'jenis' => 'required|in:urgent,non-urgent',
        ]);

        $userRequest->update([
            'jenis' => $validatedData['jenis'],
            'status' => 'pending'
        ]);

        return redirect()->route('super.dashboard')
            ->with('success', 'Status request berhasil diperbarui.');
    }
}
