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
        $order  = Order::findOrFail($id);
        $status = strtolower($request->status);

        switch ($status) {
            case 'diterima':
            case 'menunggu pembayaran':
                $order->status = 'menunggu pembayaran';
                break;

            case 'diproses':
                $order->status = 'diproses';
                // Fallback: jika belum ada jadwal produksi, buat
                $this->ensureProduksiExists($order);
                break;

            case 'selesai':
                $order->status = 'selesai';
                break;

            case 'ditolak':
                $order->status = 'ditolak';
                break;

            default:
                // biar fleksibel (misal: menunggu konfirmasi)
                $order->status = $request->status;
        }

        $order->catatan = $request->catatan;
        $order->save();

        return redirect('/admin/pesanan')->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function index(Request $request)
    {
        $q      = trim((string) $request->get('q'));
        $status = strtolower((string) $request->get('status', 'all'));

        $orders = Order::with('user')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('nama_proyek', 'like', "%{$q}%")
                       ->orWhere('id', $q)
                       ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {
                $query->whereRaw('LOWER(status) = ?', [$status]);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.pesanan', compact('orders', 'status'));
    }

    private function ensureProduksiExists(Order $order): void
    {
        $existing = Produksi::where('order_id', $order->id)->first();
        if ($existing) return;

        $tanggalMulai   = Carbon::now();
        $tanggalSelesai = $order->tenggat ? Carbon::parse($order->tenggat) : Carbon::now()->addDays(7);

        Produksi::create([
            'nama_produksi'  => 'Produksi ' . ($order->nama_proyek ?? 'Pesanan #' . $order->id),
            'order_id'       => $order->id,
            'status'         => 'terjadwal',
            'tanggal_mulai'  => $tanggalMulai->format('Y-m-d'),
            'tanggal_selesai'=> $tanggalSelesai->format('Y-m-d'),
        ]);
    }
}
