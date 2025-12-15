<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //fread - get
    public function index()
    {
        $data = Produk::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    //fget dan get by id
    public function show($id)
    {
        $data = Produk::find($id); // Cari data produk berdasarkan ID

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

    //fcreate - post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        //validasi input
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $produk = Produk::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil ditambahkan',
            '$data' => $produk
        ], 201);
    }

    //fupdate put-post
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Data produk tidak ditemukan',
            ], 404);
        }

        //update data
        $produk->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil diupdate',
            'data' => $produk
        ], 200);
    }

    //fdelete
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'status' => false,
                'message' => 'Data produk tidak ditemukan',
            ], 404);
        }

        $produk->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data produk berhasil dihapus',
        ], 200);
    }
}