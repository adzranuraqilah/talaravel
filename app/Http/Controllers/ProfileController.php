<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $tenderDiajukan = $user->orders()->where('tipe', 'tender')->count();
        $tenderDiterima = $user->orders()->where('tipe', 'tender')->where('status', 'diterima')->count();
        $tenderSelesai = $user->orders()->where('tipe', 'tender')->where('status', 'selesai')->count();
        $riwayat = $user->orders()->latest()->get();
        return view('profile', compact('user', 'tenderDiajukan', 'tenderDiterima', 'tenderSelesai', 'riwayat'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/profile')->with('success', 'Profil berhasil diperbarui!');
    }
} 