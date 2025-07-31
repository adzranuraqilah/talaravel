<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminPelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\User::query();
        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->q.'%')
                  ->orWhere('email', 'like', '%'.$request->q.'%')
                  ->orWhere('phone', 'like', '%'.$request->q.'%')
                  ->orWhere('alamat', 'like', '%'.$request->q.'%');
            });
        }
        $pelanggan = $query->withCount(['orders as total_pesanan' => function($q) {
            $q->whereNotNull('id');
        }])->withSum('orders as total_pembelian', 'budget')->get();
        return view('admin.pelanggan', compact('pelanggan'));
    }
} 