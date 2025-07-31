<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriPratinjau;

class AdminGaleriController extends Controller
{
    public function index(Request $request) {
        $query = GaleriPratinjau::query();
        if ($request->q) {
            $query->where('nama_produk', 'like', '%'.$request->q.'%');
        }
        $galeri = $query->latest()->get();
        return view('admin.galeri', compact('galeri'));
    }

    public function previewHistory() {
        $previewHistory = GaleriPratinjau::where('jenis_produk', '!=', 'kaos')->latest()->get();
        return view('admin.preview-history', compact('previewHistory'));
    }
} 