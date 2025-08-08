<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalPesanan = Order::count();
        $totalPelanggan = User::count();
        $totalPendapatan = Order::whereIn('status', ['dibayar', 'selesai'])->sum('budget');

        $pesananQuery = Order::with('user');
        if ($request->q) {
            $pesananQuery->where(function($q) use ($request) {
                $q->where('nama_proyek', 'like', '%'.$request->q.'%')
                  ->orWhereHas('user', function($qu) use ($request) {
                      $qu->where('name', 'like', '%'.$request->q.'%');
                  });
            });
        }
        $pesananTerbaru = $pesananQuery->latest()->take(5)->get();

        $status = [
            'Menunggu Konfirmasi' => Order::where('status', 'menunggu')->count(),
            'Menunggu Pembayaran' => Order::where('status', 'menunggu pembayaran')->count(),
            'Diproses' => Order::where('status', 'diproses')->count(),
            'Selesai' => Order::where('status', 'selesai')->count(),
            'Ditolak' => Order::where('status', 'ditolak')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalPesanan', 'totalPelanggan', 'totalPendapatan',
            'pesananTerbaru', 'status'
        ));
    }
}
