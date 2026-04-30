<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('user')->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id'   => 'required|array',
            'qty'         => 'required|array',
            'bayar'       => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->produk_id as $i => $produk_id) {
                $produk = Produk::findOrFail($produk_id);
                $qty = $request->qty[$i];
                $subtotal = $produk->harga * $qty;
                $total += $subtotal;

                $items[] = [
                    'produk_id' => $produk_id,
                    'qty'       => $qty,
                    'harga'     => $produk->harga,
                    'subtotal'  => $subtotal,
                ];

                // Kurangi stok otomatis
                $produk->decrement('stok', $qty);
            }

            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . date('YmdHis'),
                'user_id'        => Auth::id(),
                'total'          => $total,
                'bayar'          => $request->bayar,
                'kembalian'      => $request->bayar - $total,
            ]);

            foreach ($items as $item) {
                $item['transaksi_id'] = $transaksi->id;
                TransaksiDetail::create($item);
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil!');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('details.produk', 'user');
        return view('transaksi.show', compact('transaksi'));
    }
}