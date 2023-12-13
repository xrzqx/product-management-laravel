<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $validator =  $request->validate([
            'namakategori' => 'required|max:255',
        ], [
            'namakategori.required' => 'Input nama kategori tidak boleh kosong',
            'namakategori.max' => 'Input nama kategori tidak boleh lebih dari 255 karakter',
        ]);
        Kategori::create(
            [
                'nama_kategori' => $request->namakategori,
            ]
        );

        return redirect()->route('produk.index')->with('success', 'menambahkan kategori');
    }
}
