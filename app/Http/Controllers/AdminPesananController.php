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

    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));
        $status = strtolower((string) $request->get('status', 'all'));

        $orders = Order::with('user')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('nama_proyek', 'like', "%{$q}%")
                    ->orWhere('id', $q)
                    ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$q}%"));
                });
            })
            ->when($status !== 'all', function ($query) use ($status) {
                // samakan kapitalisasi sebelum dibandingkan
                $query->whereRaw('LOWER(status) = ?', [$status]);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString(); // supaya q & status tetap ada saat paginate

        // kirim status aktif ke view (opsional)
        return view('admin.pesanan', compact('orders', 'status'));
    }

}
