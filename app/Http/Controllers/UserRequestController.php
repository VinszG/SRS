<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserRequestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $requests = UserRequest::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('no_bpj', 'like', "%{$search}%")
                            ->orWhere('deskripsi_permasalahan', 'like', "%{$search}%");
            })
            ->orderBy('request_date', 'desc')
            ->paginate(5);

        return view('user.requests.index', compact('requests'));
    }

    public function create()
    {
        return view('user.requests.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'departemen' => 'required',
            'jabatan' => 'required',
            'request_date' => 'required|date_format:Y-m-d\TH:i',
            'deskripsi_permasalahan' => 'required',
            'bukti_foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $userRequest = new UserRequest($validatedData);
        $userRequest->user_id = Auth::id();
        
        // Generate nomor BPJ baru
        $userRequest->no_bpj = $this->generateUniqueBpjNumber();
        
        $userRequest->status = 'pending';

        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('bukti_foto', 'public');
            $userRequest->bukti_foto = $path;
        }

        $userRequest->save();

        return redirect()->route('account.user.dashboard')->with('success', 'Request berhasil dibuat.');
    }

    private function generateUniqueBpjNumber()
    {
        do {
            $randomNumber = mt_rand(1, 999);
            $formattedNumber = str_pad($randomNumber, 3, '0', STR_PAD_LEFT);
            $number = 'BPJ-0' . $formattedNumber;
            $exists = UserRequest::where('no_bpj', $number)->exists();
        } while ($exists);

        return $number;
    }

    public function show(UserRequest $request)
    {
        return view('user.requests.show', compact('request'));
    }
}
