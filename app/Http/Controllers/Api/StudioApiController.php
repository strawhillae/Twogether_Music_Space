<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioApiController extends Controller
{
    public function index()
    {
        return response()->json(Studio::all());
    }

    public function show($id)
    {
        return response()->json(Studio::findOrFail($id));
    }

    public function store(Request $request)
    {
        $studio = Studio::create($request->all());

        return response()->json([
            'message' => 'Studio berhasil ditambahkan',
            'data' => $studio
        ]);
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);

        $studio->update($request->all());

        return response()->json([
            'message' => 'Studio berhasil diupdate',
            'data' => $studio
        ]);
    }

    public function destroy($id)
    {
        Studio::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Studio berhasil dihapus'
        ]);
    }
}