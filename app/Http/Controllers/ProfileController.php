<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil + statistik pesanan.
     */
    public function show()
    {
        $user = Auth::user();

        // Total semua tender yang pernah diajukan user
        $tenderDiajukan = $user->orders()
            ->where('tipe', 'tender')
            ->count();

        // "Pesanan Diterima" = sudah bayar dan menunggu verifikasi admin
        // Kompatibel dengan status lama "diterima" jika masih ada di data lama
        $tenderDiterima = $user->orders()
            ->where('tipe', 'tender')
            ->whereIn('status', ['menunggu konfirmasi', 'diterima'])
            ->count();

        // Tender selesai
        $tenderSelesai = $user->orders()
            ->where('tipe', 'tender')
            ->where('status', 'selesai')
            ->count();

        // Riwayat semua pesanan (personal + tender)
        $riwayat = $user->orders()
            ->latest()
            ->get();

        return view('profile', compact(
            'user',
            'tenderDiajukan',
            'tenderDiterima',
            'tenderSelesai',
            'riwayat'
        ));
    }

    /**
     * Update data profil user.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:30',
            'alamat'   => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->phone  = $request->phone;
        $user->alamat = $request->alamat;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
