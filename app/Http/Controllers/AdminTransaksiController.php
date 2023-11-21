<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Monitoring Produk',
            'transaksi' => Transaksi::paginate(10),
            'content' => 'admin.transaksi.index',
        ];

        return view('admin.layouts.wrapper', $data);
    }

    public function create(Request $request)
    {
        $id_produk = $request->input('id');
        $p_detail = Produk::find($id_produk);
        $id_detail_transaksi = $request->input('id');

        $act = $request->input('act');
        $qty = $request->input('qty', 1);

        if ($act == 'min') {
            $qty = max(1, $qty - 1);
        } else {
            $qty += 1;
        }

        $subtotal = $p_detail ? $qty * $p_detail->harga : 0;

        $transaksi = Transaksi::first();

        // Check if $transaksi is null, and create a new transaction if needed
        if (!$transaksi) {
            $this->addTransaksi();
            $transaksi = Transaksi::first();
        }

        $dibayarkan = $request->input('dibayarkan');
        $kembalian = $transaksi->total !== null ? $dibayarkan - $transaksi->total : 0;

        $data = [
            'title' => 'Tambah Transaksi',
            'transaksi' => $transaksi,
            'produk' => Produk::get(),
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'detail_transaksi' => DetailTransaksi::get(),
            'kembalian' => $kembalian,
            'id_detail_transaksi' => DetailTransaksi::first(),
            'content' => 'admin.transaksi.create',
        ];

        return view('admin.layouts.wrapper', $data);
    }


    protected function addTransaksi()
    {
        $data = [
            'id_user' => auth()->user()->id,
            'nama_kasir' => auth()->user()->name,
            'total' => 0,
        ];

        Transaksi::create($data);
    }

    public function store(Request $request)
    {
        // Handle storing the data here
    }

    // Other methods remain unchanged
}
