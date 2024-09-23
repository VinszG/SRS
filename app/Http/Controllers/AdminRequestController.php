<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class AdminRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('status', 'ongoing')->get();
        return view('admin.requests.index', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        return view('admin.requests.show', compact('request'));
    }

    public function assignTeknisi(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'teknisi_id' => 'required|exists:users,id',
            'tugas' => 'required|in:pengecekan,perbaikan',
        ]);

        $userRequest->teknisi_id = $validatedData['teknisi_id'];
        $userRequest->tugas = $validatedData['tugas'];
        $userRequest->save();

        // Kirim notifikasi ke Teknisi
        return redirect()->route('admin.requests.index')->with('success', 'Teknisi berhasil ditugaskan.');
    }
}
