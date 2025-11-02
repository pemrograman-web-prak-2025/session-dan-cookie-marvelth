<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }
    public function showLogin() { return view('auth.login'); }

    public function register(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('login.show')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember_cookie = $req->has('remember');
        if (Auth::attempt($credentials, $remember_cookie)) {
            $req->session()->regenerate();
            if (!$remember_cookie) {
                config(['session.expire_on_close' => true]); // kalo gak centang, maka sessionnya habis & user balik ke login page
            }
            return redirect()->intended(route('timers.index'));
        }
        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('login.show');
    }
}
