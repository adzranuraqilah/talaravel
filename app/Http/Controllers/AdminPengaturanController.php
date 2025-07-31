<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $user = Auth::user();
        return view('admin.pengaturan', compact('setting', 'user'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first() ?? new Setting();
        $setting->nama_perusahaan = $request->nama_perusahaan;
        $setting->nama_admin = $request->nama_admin;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->alamat = $request->alamat;
        $setting->notif_pesanan_baru = $request->has('notif_pesanan_baru');
        $setting->save();

        // Update password jika diisi
        $user = Auth::user();
        if ($request->filled('password_baru') && $request->password_baru == $request->password_baru_konfirmasi) {
            if ($request->filled('password_saat_ini') && Hash::check($request->password_saat_ini, $user->password)) {
                $user->password = Hash::make($request->password_baru);
                $user->save();
            }
        }
        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
} 