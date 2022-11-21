<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'sistem pergudangan'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'password' => ['required'],
            'username' => ['required']
        ], [
            'password.required' => 'Password tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.'
        ]);
        $remember_me = $request->has('remember_me');
        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'fail'], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
