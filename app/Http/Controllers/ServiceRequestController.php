<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::where('user_id', Auth::id())->get();
        return view('service_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('service_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'problem_description' => 'required|string',
            'proof_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate BPJ number with the format "BPJYYYYMMDDXXXX"
        $no_bpj = 'BPJ' . now()->format('Ymd') . rand(1000, 9999);

        $userRequest = new UserRequest();
        $userRequest->no_bpj = $no_bpj;
        $userRequest->name = $request->name;
        $userRequest->department = $request->department;
        $userRequest->position = $request->position;
        $userRequest->request_date = $request->request_date ?? now();
        $userRequest->problem_description = $request->problem_description;

        if ($request->hasFile('proof_photo')) {
            $userRequest->proof_photo = $request->file('proof_photo')->store('proof_photos', 'public');
        }

        $userRequest->user_id = Auth::id();
        $userRequest->save();

        return redirect()->route('service_requests.index')->with('success', 'Request berhasil dibuat!');
    }

    public function show($id)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())->findOrFail($id);
        return view('service_requests.show', compact('UserRequest'));
    }

    public function edit($id)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())->findOrFail($id);
        return view('service_requests.edit', compact('UserRequest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'problem_description' => 'required|string',
            'proof_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userRequest = UserRequest::where('user_id', Auth::id())->findOrFail($id);
        $userRequest->name = $request->name;
        $userRequest->department = $request->department;
        $userRequest->position = $request->position;
        $userRequest->request_date = $request->request_date ?? now();
        $userRequest->problem_description = $request->problem_description;

        if ($request->hasFile('proof_photo')) {
            if ($userRequest->proof_photo) {
                Storage::disk('public')->delete($userRequest->proof_photo);
            }
            $userRequest->proof_photo = $request->file('proof_photo')->store('proof_photos', 'public');
        }

        $userRequest->save();

        return redirect()->route('service_requests.index')->with('success', 'Request berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $userRequest = UserRequest::where('user_id', Auth::id())->findOrFail($id);

        if ($userRequest->proof_photo) {
            Storage::disk('public')->delete($userRequest->proof_photo);
        }

        $userRequest->delete();

        return redirect()->route('service_requests.index')->with('success', 'Request berhasil dihapus!');
    }
}
