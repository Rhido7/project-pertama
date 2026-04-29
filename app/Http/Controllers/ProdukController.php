<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|min:3|max:100',
            'kategori' => 'required|min:3|max:50',
            'harga'    => 'required|numeric|min:0',
            'stok'     => 'required|numeric|min:0',
        ]);

        Produk::create($request->all());
        return redirect()->route('produk.index');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
         'nama'     => 'required|min:3|max:100',
         'kategori' => 'required|min:3|max:50',
         'harga'    => 'required|numeric|min:0',
         'stok'     => 'required|numeric|min:0',
        ]);

         $produk->update($request->all());
        return redirect()->route('produk.index');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index');
    }
}