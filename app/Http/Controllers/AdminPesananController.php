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
        $action = strtolower((string) $request->status); // nilai dari tombol/admin
        $final  = $order->status;

        // Normalisasi aksi admin -> status akhir
        switch ($action) {
            case 'diterima':
            case 'diproses':
                // setelah customer bayar (menunggu konfirmasi), admin "diterima" => diproses
                $final = 'diproses';
                break;

            case 'selesai':
                $final = 'selesai';
                break;

            case 'ditolak':
                $final = 'ditolak';
                break;

            // opsi jika ingin mengembalikan status (jika kamu pakai tombolnya)
            case 'menunggu konfirmasi':
            case 'kembali-menunggu-konfirmasi':
                $final = 'menunggu konfirmasi';
                break;

            case 'menunggu pembayaran':
            case 'kembali-menunggu-pembayaran':
                $final = 'menunggu pembayaran';
                break;

            default:
                // jika admin mengirim status bebas, pakai apa adanya
                if (!empty($action)) {
                    $final = $action;
                }
        }

        $order->status  = $final;
        $order->catatan = $request->catatan;
        $order->save();

        // Otomatis buat jadwal produksi saat masuk "diproses"
        if ($final === 'diproses') {
            $existingProduksi = Produksi::where('order_id', $order->id)->first();

            if (!$existingProduksi) {
                $tanggalMulai   = Carbon::now();
                $tanggalSelesai = $order->tenggat ? Carbon::parse($order->tenggat) : Carbon::now()->addDays(7);

                Produksi::create([
                    'nama_produksi'   => 'Produksi ' . ($order->nama_proyek ?? 'Pesanan #' . $order->id),
                    'order_id'        => $order->id,
                    'status'          => 'terjadwal',
                    'tanggal_mulai'   => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                ]);
            }
        }

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
                // samakan kapitalisasi sebelum dibandingkan
                $query->whereRaw('LOWER(status) = ?', [$status]);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString(); // supaya q & status tetap ada saat paginate

        return view('admin.pesanan', compact('orders', 'status'));
    }
}
