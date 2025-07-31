<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;



class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');
        $start = $request->tanggal_mulai ? Carbon::parse($request->tanggal_mulai.' 00:00:00', 'Asia/Jakarta') : $now->copy()->startOfMonth();
        $end = $request->tanggal_akhir ? Carbon::parse($request->tanggal_akhir.' 23:59:59', 'Asia/Jakarta') : $now->copy()->endOfMonth();

        $penjualanBulanIni = Order::whereBetween('created_at', [$start, $end])->get()->sum(function($order) {
            return (float) $order->budget;
        });
        $pesananBulanIni = Order::whereBetween('created_at', [$start, $end])->count();
        $pelangganBaru = User::whereBetween('created_at', [$start, $end])->count();
        $produkTerjual = Order::whereBetween('created_at', [$start, $end])->sum('kuantitas');

        // Data tabel laporan penjualan (per hari)
        $laporan = [];
        $period = $start->copy();
        while ($period <= $end) {
            $orders = Order::whereDate('created_at', $period->toDateString())->get();
            $totalPelanggan = $orders->pluck('user_id')->unique()->count();
            $totalPesanan = $orders->count();
            $totalPenjualan = $orders->sum(function($order) { return (float) $order->budget; });
            $laporan[] = [
                'tanggal' => $period->format('d-m-Y'),
                'total_pelanggan' => $totalPelanggan,
                'total_pesanan' => $totalPesanan,
                'total_penjualan' => $totalPenjualan,
            ];
            $period->addDay();
        }

        return view('admin.laporan', compact(
            'penjualanBulanIni',
            'pesananBulanIni',
            'pelangganBaru',
            'produkTerjual',
            'laporan',
            'start',
            'end'
        ));
    }

    public function exportPdf(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');
        $start = $request->tanggal_mulai ? Carbon::parse($request->tanggal_mulai.' 00:00:00', 'Asia/Jakarta') : $now->copy()->startOfMonth();
        $end = $request->tanggal_akhir ? Carbon::parse($request->tanggal_akhir.' 23:59:59', 'Asia/Jakarta') : $now->copy()->endOfMonth();

        $laporan = [];
        $period = $start->copy();
        while ($period <= $end) {
            $orders = Order::whereDate('created_at', $period->toDateString())->get();
            $totalPelanggan = $orders->pluck('user_id')->unique()->count();
            $totalPesanan = $orders->count();
            $totalPenjualan = $orders->sum(function($order) { return (float) $order->budget; });
            $laporan[] = [
                'tanggal' => $period->format('d-m-Y'),
                'total_pelanggan' => $totalPelanggan,
                'total_pesanan' => $totalPesanan,
                'total_penjualan' => $totalPenjualan,
            ];
            $period->addDay();
        }
        
        try {
            $html = view('admin.laporan-pdf', compact('laporan', 'start', 'end'))->render();
            $dompdf = app('dompdf');
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            return response($dompdf->output(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="laporan-penjualan.pdf"'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }
} 