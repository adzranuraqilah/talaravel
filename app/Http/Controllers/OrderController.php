<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showPersonalForm()
    {
        return view('personal-form');
    }

    public function submitPersonal(Request $request)
    {
        if (!Auth::check()) {
            session()->put('pending_form', $request->all());
            session()->put('pending_form_type', 'personal');
            return redirect('/login');
        }

        $validated = $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'kuantitas'   => 'required|integer|min:24',
            'tenggat'     => 'required|date',
            'desain'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'budget'      => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('desain')) {
            $validated['desain'] = $request->file('desain')->store('desain', 'public');
        }

        $validated['tipe']    = 'personal';
        $validated['user_id'] = Auth::id();
        $validated['status']  = 'menunggu konfirmasi'; // <— sesuai alur baru

        Order::create($validated);

        return redirect('/terima-kasih');
    }

    public function showTenderForm()
    {
        return view('tender-form');
    }

    public function submitTender(Request $request)
    {
        if (!Auth::check()) {
            session()->put('pending_form', $request->all());
            session()->put('pending_form_type', 'tender');
            return redirect('/login');
        }

        $validated = $request->validate([
            'instansi'    => 'nullable|string|max:255',
            'nama_proyek' => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'kuantitas'   => 'required|integer|min:24',
            'tenggat'     => 'required|date',
            'budget'      => 'required',
            'desain'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('desain')) {
            $validated['desain'] = $request->file('desain')->store('desain', 'public');
        }

        $validated['tipe']    = 'tender';
        $validated['user_id'] = Auth::id();
        $validated['status']  = 'menunggu konfirmasi'; // <— sesuai alur baru

        Order::create($validated);

        return redirect('/terima-kasih');
    }

    public function showDetail($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('order-detail', compact('order'));
    }
}
