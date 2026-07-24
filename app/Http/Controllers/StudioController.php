<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::latest()->get();
        return view('admin.studios.index', compact('studios'));
    }

    public function create()
    {
        return view('admin.studios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_studio' => 'required|string|max:255',
            'jenis' => 'required|in:Recording,Residence',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Tersedia,Maintenance',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('studios', 'public');
        }

        Studio::create($validated);

        return redirect()->route('admin.studios.index')->with('success', 'Studio berhasil ditambahkan.');
    }

    public function show(Studio $studio)
    {
        return view('admin.studios.show', compact('studio'));
    }

    public function edit(Studio $studio)
    {
        return view('admin.studios.edit', compact('studio'));
    }

    public function update(Request $request, Studio $studio)
    {

        $validated = $request->validate([
            'nama_studio' => 'required|string|max:255',
            'jenis' => 'required|in:Recording,Residence',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:Tersedia,Maintenance',
        ]);

        if ($request->hasFile('foto')) {
            if ($studio->foto) {
                Storage::disk('public')->delete($studio->foto);
            }
            $validated['foto'] = $request->file('foto')->store('studios', 'public');
        }

        $studio->update($validated);

        return redirect()->route('admin.studios.index')->with('success', 'Studio berhasil diperbarui.');
    }

    public function destroy(Studio $studio)
    {
        if ($studio->foto) {
            Storage::disk('public')->delete($studio->foto);
        }
        $studio->delete();

        return redirect()->route('admin.studios.index')->with('success', 'Studio berhasil dihapus.');
    }
}