<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Studio;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('studio')->get();

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        $studios = Studio::all();

        return view('admin.facilities.create', compact('studios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studio_id' => 'required',
            'nama_fasilitas' => 'required',
            'kategori' => 'required',
        ]);

        Facility::create($request->all());

        return redirect()->route('admin.facilities.index')
                         ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        $studios = Studio::all();

        return view('admin.facilities.edit', compact('facility','studios'));
    }

    public function update(Request $request, Facility $facility)
    {
        $facility->update($request->all());

        return redirect()->route('admin.facilities.index');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index');
    }
}