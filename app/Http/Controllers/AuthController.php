<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('students.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // Handle remember checkbox - default to false if not present
        $remember = $request->has('remember') ? true : false;

        $ok = Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember);
        if (! $ok) {
            return back()->withErrors(['email' => 'Invalid login'])->withInput();
        }
        $request->session()->regenerate();
        return redirect()->intended(route('students.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
