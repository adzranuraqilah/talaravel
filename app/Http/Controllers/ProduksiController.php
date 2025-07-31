<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Order;

class ProduksiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua jadwal produksi dengan relasi order dan user
        $produksi = Produksi::with(['order.user'])->latest()->get();
        
        // Hitung statistik
        $sedangBerlangsung = Produksi::where('status', 'sedang_berlangsung')->count();
        $terjadwal = Produksi::where('status', 'terjadwal')->count();
        $pending = Produksi::where('status', 'pending')->count();
        $selesaiBulanIni = Produksi::where('status', 'selesai')
            ->whereMonth('tanggal_selesai', now()->month)
            ->count();

        return view('admin.produksi', compact('produksi', 'sedangBerlangsung', 'terjadwal', 'pending', 'selesaiBulanIni'));
    }

    public function updateStatus(Request $request, $id)
    {
        $produksi = Produksi::findOrFail($id);
        $produksi->status = $request->status;
        
        // Update tanggal sesuai status
        if ($request->status === 'sedang_berlangsung') {
            $produksi->tanggal_mulai = now()->format('Y-m-d');
        } elseif ($request->status === 'selesai') {
            $produksi->tanggal_selesai = now()->format('Y-m-d');
        }
        
        $produksi->save();

        return redirect()->back()->with('success', 'Status produksi berhasil diupdate!');
    }
} 