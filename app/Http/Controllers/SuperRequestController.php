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

        // Jika jenis 'urgent', set status menjadi 'admins', jika tidak, set status menjadi 'plants'
        $status = $validatedData['jenis'] === 'urgent' ? 'admins' : 'plants';

        $userRequest->update([
            'jenis' => $validatedData['jenis'],
            'status' => $status
        ]);

        return redirect()->route('super.dashboard')
            ->with('success', 'Status request berhasil diperbarui.');
    }

}
