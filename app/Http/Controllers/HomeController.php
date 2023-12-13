<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori', 'status')
            ->whereHas('status', function (Builder $query) {
                $query->where('nama_status', 'like', 'bisa dijual%');
            })
            ->paginate(8);
        $kategori = Kategori::all();
        $status = Status::all();
        return view("welcome", [
            "produks" => $produks,
            "kategoris" => $kategori,
            "status" => $status
        ]);
    }
    public function search(Request $request)
    {
        $searchQuery = $request->input('name');

        // Perform the search based on the query parameter
        $produks = Produk::with('kategori', 'status')
            ->whereHas('status', function (Builder $query) {
                $query->where('nama_status', 'like', 'bisa dijual%');
            })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('nama_produk', 'like', '%' . $searchQuery . '%');
            })
            ->paginate(8);

        $kategori = Kategori::all();
        $status = Status::all();
        return view("welcome", [
            "produks" => $produks,
            "kategoris" => $kategori,
            "status" => $status
        ]);
    }
    public function store(Request $request)
    {
        $validator =  $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|numeric',
            'status' => 'required|numeric',
        ], [
            'nama.required' => 'Input nama tidak boleh kosong',
            'nama.max' => 'Input nama tidak boleh lebih dari 255 karakter',
            'harga.required' => 'Input harga tidak boleh kosong',
            'harga.numeric' => 'Input harga harus nomor',
            'kategori.required' => 'Input kategori harus benar',
            'kategori.numeric' => 'Input kategori harus benar',
            'status.required' => 'Input status harus benar',
            'status.numeric' => 'Input status harus benar',
        ]);
        Produk::create(
            [
                'nama_produk' => $request->nama,
                'harga' => $request->harga,
                'kategori_id' => $request->kategori,
                'status_id' => $request->status,
            ]
        );

        return back()->with('success', 'menambahkan produk');
    }
    public function edit($id)
    {
        $produk = Produk::with('kategori', 'status')
            ->where('id_produk', $id)
            ->get();
        if (!$produk) {
            // Handle case where the resource is not found
            abort(404, 'Resource not found');
        }
        $kategoris = Kategori::all();
        $status = Status::all();
        return view('edit', compact('produk', 'kategoris', 'status'));
    }

    public function update(Request $request, $id)
    {
        $validator =  $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|numeric',
            'status' => 'required|numeric',
        ], [
            'nama.required' => 'Input nama tidak boleh kosong',
            'nama.max' => 'Input nama tidak boleh lebih dari 255 karakter',
            'harga.required' => 'Input harga tidak boleh kosong',
            'harga.numeric' => 'Input harga harus nomor',
            'kategori.required' => 'Input kategori harus benar',
            'kategori.numeric' => 'Input kategori harus benar',
            'status.required' => 'Input status harus benar',
            'status.numeric' => 'Input status harus benar',
        ]);
        $produk = Produk::find($id);
        if (!$produk) {
            // Handle case where the resource is not found
            abort(404, 'Resource not found');
        }
        $produk->nama_produk = $request->nama;
        $produk->harga = $request->harga;
        $produk->kategori_id = $request->kategori;
        $produk->status_id = $request->status;
        $produk->save();

        return redirect('/')->with('success', 'mengubah produk');
    }
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            // Handle case where the resource is not found
            abort(404, 'Resource not found');
        }
        $produk->delete();
        return redirect('/')->with('success', 'menghapus produk');
    }
}
