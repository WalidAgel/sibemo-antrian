<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AntrianController extends Controller
{
    // SET DATA
    public function setData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kendaraan_id' => 'required|integer|exists:kendaraan,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'keluhan' => 'required|string',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $antrian = Antrian::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data antrian berhasil ditambahkan',
            'data' => $antrian
        ]);
    }

    // GET DATA
    public function getData()
    {
        $data = Antrian::with('kendaraan')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data antrian berhasil diambil',
            'data' => $data,
            'total_data' => $data->count()
        ]);
    }

    // UPDATE DATA
    public function updateData(Request $request, $id)
    {
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return response()->json([
                'status' => false,
                'message' => 'Data antrian tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'kendaraan_id' => 'integer|exists:kendaraan,id',
            'tanggal' => 'date',
            'waktu' => 'string',
            'keluhan' => 'string',
            'status' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $antrian->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data antrian berhasil diperbarui',
            'data' => $antrian
        ]);
    }

    // DELETE DATA
    public function deleteData($id)
    {
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return response()->json([
                'status' => false,
                'message' => 'Data antrian tidak ditemukan'
            ], 404);
        }

        $antrian->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data antrian berhasil dihapus'
        ]);
    }
}
