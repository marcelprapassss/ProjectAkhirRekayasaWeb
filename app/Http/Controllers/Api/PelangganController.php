<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    //read data - get (semua data)
    public function index()
    {
        $data = Pelanggan::all();

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan ditemukan',
            'data' => $data
        ], 200);
    }

    //read data - berdasarkan id - get
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan ditemukan',
            'data' => $pelanggan
        ], 200);
    }

    //create data - post
    public function store(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $pelanggan = Pelanggan::create($request->only([
            'nama_pelanggan',
            'alamat',
            'no_hp'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ], 201);
    }

    //update data - put
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan',
            ], 404);
        }

        //validasi data input
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        //validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data pelanggan
        $pelanggan->update($request->only([
            'nama_pelanggan',
            'alamat',
            'no_hp'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil diupdate',
            'data' => $pelanggan
        ], 200);
    }

    //delete data
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        // Cek apakah data pelanggan ada
        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan',
            ], 404);
        }

        // Hapus data pelanggan
        $pelanggan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil dihapus',
        ], 200);
    }
}