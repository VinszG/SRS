<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class TeknisiRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('teknisi_id', auth('teknisi')->id())->get();
        return view('teknisi.requests.index', compact('requests'));
    }

    public function show(UserRequest $request)
    {
        return view('teknisi.requests.show', compact('request'));
    }

    public function updateStatus(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,ongoing,done',
        ]);

        $userRequest->status = $validatedData['status'];
        $userRequest->save();

        return redirect()->route('teknisi.requests.index')->with('success', 'Status request berhasil diupdate.');
    }

    public function reportPerbaikan(Request $request, UserRequest $userRequest)
    {
        $validatedData = $request->validate([
            'jenis_perbaikan' => 'required|in:internal,eksternal',
        ]);

        $userRequest->jenis_perbaikan = $validatedData['jenis_perbaikan'];
        $userRequest->save();

        if ($validatedData['jenis_perbaikan'] === 'eksternal') {
            // Kirim notifikasi ke Plant Manager untuk konfirmasi
        } else {
            // Kirim notifikasi ke Admin untuk perbaikan internal
        }

        return redirect()->route('teknisi.requests.index')->with('success', 'Laporan perbaikan berhasil dikirim.');
    }
}
