<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    // SET DATA: Menambahkan pelanggan
    public function setData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = Pelanggan::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil disimpan',
            'data' => $pelanggan,
        ]);
    }

    // GET DATA: Mengambil semua pelanggan
    public function getData()
    {
        $data = Pelanggan::all();

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil diambil',
            'data' => $data,
            'total_data' => $data->count(),
        ]);
    }

    // UPDATE DATA: Memperbarui data pelanggan berdasarkan ID
    public function updateData(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:100',
            'no_hp' => 'string|max:15',
            'alamat' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil diperbarui',
            'data' => $pelanggan,
        ]);
    }

    // DELETE DATA: Menghapus data pelanggan
    public function deleteData($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ]);
    }
}
