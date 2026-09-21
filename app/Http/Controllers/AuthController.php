<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt([...$credentials, 'status'=>'Active'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success','Welcome back!');
        }
        return back()->withErrors(['email'=>'Invalid credentials or inactive account.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out.');
    }
}
