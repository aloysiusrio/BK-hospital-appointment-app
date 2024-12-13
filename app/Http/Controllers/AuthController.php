<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('pasien')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $notification = array(
                'status' => 'toast_success',
                'title' => 'Login Berhasil',
                'message' => 'Login Berhasil',
            );

            return redirect()->intended('/dashboard')->with($notification);
        }
        $notification = array(
            'status' => 'error',
            'title' => 'Login Gagal',
            'message' => 'Username / Password Salah',
        );
        return back()->with($notification);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'status' => 'toast_success',
            'title' => 'Logout Berhasil',
            'message' => 'Logout Berhasil'
        );
        return redirect('/')->with($notification);
    }
}
