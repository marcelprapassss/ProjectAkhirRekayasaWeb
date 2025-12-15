<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    //fread - get
    public function index()
    {
        $data = Pelanggan::all();
        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan ditemukan',
            'data' => $data
        ], 200);
    }

    //fread - get by id
    public function show($id)
    {
        $data = Pelanggan::find($id); 

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    // fcreate - post
    public function store(Request $request)
    {
        //validasi input email
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pelanggan = Pelanggan::create($request->all());
        
        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ], 201);
    }

    // fupdate put-post
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan',
            ], 404);
        }

        // update data
        $pelanggan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil diupdate',
            'data' => $pelanggan
        ], 200);
    }

    // fdelete
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'status' => false,
                'message' => 'Data pelanggan tidak ditemukan',
            ], 404);
        }

        $pelanggan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data pelanggan berhasil dihapus',
        ], 200);
    }
}