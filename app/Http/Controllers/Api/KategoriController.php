<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    //read data - get (semua data)
    public function index()
    {
        $data = Kategori::all();

        return response()->json([
            'status' => true,
            'message' => 'Data kategori ditemukan',
            'data' => $data
        ], 200);
    }

    //create data - post
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = Kategori::create($request->only([
            'nama_kategori'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    //read data - berdasarkan id - get
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data kategori ditemukan',
            'data' => $kategori
        ], 200);
    }

    //update data - put
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori->update($request->only([
            'nama_kategori'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil diupdate',
            'data' => $kategori
        ], 200);
    }

    //delete data
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