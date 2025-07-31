<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('tools', 'public');
        }

        Tool::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
        ]);

        return redirect('/admin/galeri')->with('success', 'Tool berhasil ditambah!');
    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        return view('admin.tools-edit', compact('tool'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $tool = Tool::findOrFail($id);
        
        $gambarPath = $tool->gambar; // Keep existing image if no new image uploaded
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($tool->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($tool->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($tool->gambar);
            }
            $gambarPath = $request->file('gambar')->store('tools', 'public');
        }

        $tool->update([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
        ]);

        return redirect('/admin/galeri')->with('success', 'Tool berhasil diupdate!');
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        
        // Delete image if exists
        if ($tool->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($tool->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($tool->gambar);
        }
        
        $tool->delete();
        return redirect('/admin/galeri')->with('success', 'Tool berhasil dihapus!');
    }
}
