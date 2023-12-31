<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;


class AdminTransaksiDetailController extends Controller
{
    //
    function create(Request $request)
    {
        // die('masuk');
        // dd($request->all());
        $produk_id = $request->produk_id;
        $transaksi_id = $request->transaksi_id;

        $td = TransaksiDetail::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();

        $transaksi = Transaksi::find($transaksi_id);

        if ($td == null) {
            $data = [
                'produk_id' => $produk_id,
                'produk_name' => $request->produk_name,
                'transaksi_id'  => $transaksi_id,
                'qty'  => $request->qty,
                'subtotal'  => $request->subtotal,
            ];
            TransaksiDetail::create($data);
            // mulai dari sini yaa
            $produk = Produk::find($produk_id);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                'stok' => $old_stok - $request->qty
            ]);

            // dd([
            //     'oldstok' => $produk,
            //     'qty' => $request->qty,
            //     'new stok' => $old_stok - $request->qty
            // ]);

            $dt = [
                'total' => $request->subtotal + $transaksi->total
            ];
            $transaksi->update($dt);
        } else {
            $data = [
                'qty'  => $td->qty + $request->qty,
                'subtotal'  => $request->subtotal + $td->subtotal,
            ];
            $td->update($data);

            // disini juga kalau produknya udah ada di itunya
            $produk = Produk::find($produk_id);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                'stok' => $old_stok - $request->qty
            ]);

            // trus masih ada pr kalau produknya gajadi dibeli berarti stoknya balik lagi
            // itu di destroy data (maybe)

            $dt = [
                'total' => $request->subtotal + $transaksi->total
            ];
            $transaksi->update($dt);
        }

        return redirect('/transaksi/' . $transaksi_id . '/edit');
    }

    function delete()
    {
        $id = request('id');
        // maybe we can get the product id from this
        $td = TransaksiDetail::find($id);

        $transaksi = Transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal,
        ];
        $transaksi->update($data);

        // im so lazy so i just copied it from above
        // why you spell produk_id, indonesian + eng
        $produk = Produk::find($td->produk_id);
        // ngambil stok lama
        $old_stok = $produk->stok;
        // kalkulasi stok
        $produk->update([
            // change it to addition
            'stok' => $old_stok + $td->qty
        ]);

        // refresh is for if you have a dat, an you updated it, so get the fresh data (love sign if you understand <3333)
        // dd($produk->refresh());

        $td->delete();
        return redirect()->back();
    }

    function done($id)
    {
        $transaksi = Transaksi::first();
        $data = [
            'status' => 'selesai'
        ];
        $transaksi->update($data);
        return redirect('/transaksi');
    }
}
