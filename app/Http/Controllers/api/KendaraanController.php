<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List kendaraan',
            'data' => Kendaraan::with('pelanggan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'nomor_polisi' => 'required',
            'merek' => 'required',
            'tipe' => 'required',
            'tahun' => 'required|numeric',
        ]);

        $kendaraan = Kendaraan::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => $kendaraan,
        ]);
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::with('pelanggan')->find($id);
        if (!$kendaraan) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $kendaraan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $kendaraan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Kendaraan berhasil diupdate',
            'data' => $kendaraan,
        ]);
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $kendaraan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kendaraan berhasil dihapus',
        ]);
    }
}
