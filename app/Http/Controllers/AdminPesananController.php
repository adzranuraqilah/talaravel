<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produksi;
use Carbon\Carbon;

class AdminPesananController extends Controller
{
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.pesanan-detail', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->status;
        
        // Logika status yang lebih jelas
        switch ($status) {
            case 'diterima':
                $order->status = 'menunggu pembayaran';
                break;
            case 'diproses':
                $order->status = 'diproses';
                break;
            case 'selesai':
                $order->status = 'selesai';
                break;
            case 'ditolak':
                $order->status = 'ditolak';
                break;
            default:
                $order->status = $status;
        }
        
        $order->catatan = $request->catatan;
        $order->save();

        // Otomatis buat jadwal produksi jika status berubah menjadi 'diproses'
        if ($status === 'diproses') {
            // Cek apakah sudah ada produksi untuk order ini
            $existingProduksi = Produksi::where('order_id', $order->id)->first();
            
            if (!$existingProduksi) {
                // Hitung tanggal mulai dan selesai berdasarkan tenggat waktu
                $tanggalMulai = Carbon::now();
                $tanggalSelesai = Carbon::parse($order->tenggat);
                
                // Buat jadwal produksi baru
                Produksi::create([
                    'nama_produksi' => 'Produksi ' . $order->nama_proyek,
                    'order_id' => $order->id,
                    'status' => 'terjadwal',
                    'tanggal_mulai' => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                ]);
            }
        }

        return redirect('/admin/pesanan')->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function index(Request $request) {
        $query = \App\Models\Order::with('user');
        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('nama_proyek', 'like', '%'.$request->q.'%')
                  ->orWhereHas('user', function($qu) use ($request) {
                      $qu->where('name', 'like', '%'.$request->q.'%');
                  });
            });
        }
        $orders = $query->latest()->get();
        return view('admin.pesanan', compact('orders'));
    }
} 