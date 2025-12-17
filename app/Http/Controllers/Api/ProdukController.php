<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //read data - get (semua data)
    public function index()
    {
        $data = Produk::all();

        return response()->json([
            'status' => true,
            'message' => 'Data produk ditemukan',
            'data' => $data
        ], 200);
    }

    //read data - berdasarkan id - get
    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Data produk tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data produk ditemukan',
            'data' => $produk
        ], 200);
    }

    //create data - post
    public function store(Request $request)
    {
        //validasi data input
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        //simpan data produk ke database
        $produk = Produk::create($request->only([
            'nama_produk',
            'harga',
            'kategori_id'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    //update data - put
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Data produk tidak ditemukan',
            ], 404);
        }

        //validasi data input
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // update data
        $produk->update($request->only([
            'nama_produk',
            'harga',
            'kategori_id'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil diupdate',
            'data' => $produk
        ], 200);
    }

    //delete data produk
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Data produk tidak ditemukan',
            ], 404);
        }

        //delete
        $produk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil dihapus',
        ], 200);
    }
}