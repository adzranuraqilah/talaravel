<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Pendapatan: hitung yang sudah dibayar/masuk proses/selesai
        $totalPendapatan = Order::whereRaw("LOWER(status) IN ('dibayar','diproses','selesai')")->sum('budget');

        $totalPesanan   = Order::count();
        $totalPelanggan = User::count();

        // Pencarian untuk list "Pesanan Terbaru"
        $pesananQuery = Order::with('user');
        if ($request->q) {
            $q = trim($request->q);
            $pesananQuery->where(function ($qq) use ($q) {
                $qq->where('nama_proyek', 'like', "%{$q}%")
                   ->orWhere('id', $q)
                   ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$q}%"));
            });
        }
        $pesananTerbaru = $pesananQuery->latest()->take(5)->get();

        // Ringkasan status (case-insensitive)
        $status = [
            'Menunggu Konfirmasi' => Order::whereRaw("LOWER(status) IN ('menunggu', 'menunggu konfirmasi')")->count(),
            'Menunggu Pembayaran' => Order::whereRaw("LOWER(status) = 'menunggu pembayaran'")->count(),
            'Diproses'            => Order::whereRaw("LOWER(status) = 'diproses'")->count(),
            'Selesai'             => Order::whereRaw("LOWER(status) = 'selesai'")->count(),
            'Ditolak'             => Order::whereRaw("LOWER(status) = 'ditolak'")->count(),
        ];

        return view('admin.dashboard', compact(
            'totalPesanan', 'totalPelanggan', 'totalPendapatan',
            'pesananTerbaru', 'status'
        ));
    }
}
