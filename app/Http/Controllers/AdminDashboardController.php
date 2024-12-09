<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    // Menampilkan Dashboard Untuk Admin
    public function index(){
        return view('admin.dashboard');
    }
    
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function processRegisterAdmin(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:user,admin,plant,super,teknisi'
        ]);
    
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
    
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil membuat akun baru');
        } else {
            return redirect()->route('admin.register')
                ->withInput()
                ->withErrors($validator);
        }
    }
}