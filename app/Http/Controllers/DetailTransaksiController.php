<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function store(Request $request)
    {
        $id_transaksi = $request->id_transaksi;
        $id_produk = $request->id_produk;

        $transaksi = Transaksi::find($id_transaksi);
        $detail_transaksi = DetailTransaksi::whereIdProduk($id_produk)->whereIdTransaksi($id_transaksi)->first();

        if ($detail_transaksi == null) {
            $data = [
                'id_transaksi' => $id_transaksi,
                'id_produk' => $id_produk,
                'nama_produk' => $request->nama_produk,
                'qty' => $request->qty,
                'subtotal' => $request->subtotal,
            ];

            DetailTransaksi::create($data);

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
            ];

            $transaksi->update($dt);
        } else {
            $data = [
                'qty' => $detail_transaksi->qty + $request->qty,
                'subtotal' => $detail_transaksi->subtotal + $request->subtotal,
            ];

            $detail_transaksi->update($data);

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
            ];

            $transaksi->update($dt);
        }


        return redirect()->route('admin.transaksi.create');
    }
}
