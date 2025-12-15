<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    //fread - get
    public function index()
    {
        $data = Kategori::all();
        return response()->json([
            'status' => true,
            'message' => 'Data kategori ditemukan',
            'data' => $data
        ], 200);
    }

    // fcreate - post
    public function store(Request $request)
    {
        //validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori = Kategori::create($request->all());
        
        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    //fget dan get by id
    public function show($id)
    {
        $data = Kategori::find($id);

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

    // fupdate put-post
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan',
            ], 404);
        }

        // update data
        $kategori->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil diupdate',
            'data' => $kategori
        ], 200);
    }
        // fdelete
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan',
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil dihapus',
        ], 200);
    }
}