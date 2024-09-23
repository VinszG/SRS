<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class SuperRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('status', 'pending')->get();
        return view('super.requests.index', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        return view('super.requests.show', compact('request'));
    }

    public function updateJenis(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'jenis' => 'required|in:urgent,non-urgent',
        ]);

        $userRequest->jenis = $validatedData['jenis'];
        $userRequest->status = $validatedData['jenis'] === 'urgent' ? 'ongoing' : 'pending';
        $userRequest->save();

        if ($validatedData['jenis'] === 'non-urgent') {
            // Kirim notifikasi ke Plant Manager
        }

        return redirect()->route('super.requests.index')->with('success', 'Jenis request berhasil diupdate.');
    }
}
