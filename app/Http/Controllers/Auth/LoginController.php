<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Check if user is admin
            if (Auth::user()->is_admin) {
                return redirect('/admin/dashboard');
            }
            
            // Handle pending forms for regular users
            if (session('pending_form_type') === 'tender') {
                $request->session()->forget(['pending_form', 'pending_form_type']);
                return redirect('/tender');
            } elseif (session('pending_form_type') === 'personal') {
                $request->session()->forget(['pending_form', 'pending_form_type']);
                return redirect('/personal');
            }
            return redirect('/profile');
        }
        return back()->with('error', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
} 