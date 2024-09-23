<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Menampilkan Login Page Untuk User
    public function index() {
        return view('login');
    }   

    // Autentikasi User
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withInput($request->only('email'))
                ->withErrors($validator);
        }

        $this->checkTooManyFailedAttempts($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));

            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        RateLimiter::hit($this->throttleKey($request), 60);

        return redirect()->route('account.login')
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Password atau Email Salah']);
    }

    protected function checkTooManyFailedAttempts(Request $request)
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ]);
    }

    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    }

    protected function redirectBasedOnRole($role)
{
    $routes = [
        'admin' => 'admin.dashboard',
        'user' => 'account.user.dashboard',
        'plant' => 'plant.dashboard',
        'super' => 'super.dashboard',
        'teknisi' => 'teknisi.dashboard'
    ];

    return redirect()->route($routes[$role] ?? 'home')->with('loginSuccess', 'SELAMAT ANDA BERHASIL LOGIN');
}

    // Menampilkan Page Register User 
    public function register() {
        return view('register');
    }

    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]); 

        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user'; // Atur default role sebagai 'user', bisa diubah sesuai kebutuhan
            $user->save();

            return redirect()->route('account.login')->with('success', 'Kamu Berhasil Melakukan Registrasi');
        } else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('account.login');
    }
}

// class LoginController extends Controller
// {
//     // Menampilkan Login Page Untuk User
//     public function index() {
//         return view('login');
//     }   

//     // Autentikasi User
//     public function authenticate(Request $request) {
//         $validator = Validator::make($request->all(), [
//             'email' => 'required|email',
//             'password' => 'required'
//         ]);

//         if ($validator->passes()) {
//             if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//                 $user = Auth::user();

//                 // Redirect berdasarkan role
//                 switch ($user->role) {
//                     case 'admin':
//                         return redirect()->route('admin.dashboard');
//                     case 'user':
//                         return redirect()->route('account.dashboard');
//                     case 'plant':
//                         return redirect()->route('plant.dashboard');
//                     case 'super':
//                         return redirect()->route('super.dashboard');
//                     case 'teknisi':
//                         return redirect()->route('teknisi.dashboard');
//                     default:
//                         return redirect()->route('home'); // Redirect ke halaman default jika role tidak dikenali
//                 }
//             } else {
//                 return redirect()->route('account.login')->with('error', 'Password atau Email Salah');
//             }
//         } else {
//             return redirect()->route('account.login')
//                 ->withInput()
//                 ->withErrors($validator);
//         }
//     }

//     // Menampilkan Page Register User 
//     public function register() {
//         return view('register');
//     }

//     public function processRegister(Request $request) {
//         $validator = Validator::make($request->all(), [
//             'email' => 'required|email|unique:users',
//             'password' => 'required|confirmed'
//         ]);

//         if ($validator->passes()) {
//             $user = new User();
//             $user->name = $request->name;
//             $user->email = $request->email;
//             $user->password = Hash::make($request->password);
//             $user->role = 'user'; // Atur default role sebagai 'user', bisa diubah sesuai kebutuhan
//             $user->save();

//             return redirect()->route('account.login')->with('success', 'Kamu Berhasil Melakukan Registrasi');
//         } else {
//             return redirect()->route('account.register')
//                 ->withInput()
//                 ->withErrors($validator);
//         }
//     }

//     public function logout() {
//         Auth::logout();
//         return redirect()->route('account.login');
//     }
// }

