<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id_transaksi' => 'required',
            'id_produk' => 'required',
            'nama_produk' => 'required',
            'qty' => 'required|numeric|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $id_transaksi = $request->id_transaksi;
        $id_produk = $request->id_produk;

        // Find or create Transaksi
        $transaksi = Transaksi::find($id_transaksi);
        if (!$transaksi) {
            $transaksi = Transaksi::create([
                'id' => $id_transaksi,
                'id_user' => auth()->user()->id,
                'total' => 0
            ]);
        }

        $detail_transaksi = DetailTransaksi::where('id_produk', $id_produk)
            ->where('id_transaksi', $id_transaksi)
            ->first();

        $data = [
            'id_transaksi' => $id_transaksi,
            'id_produk' => $id_produk,
            'nama_produk' => $request->nama_produk,
            'qty' => $request->qty,
            'subtotal' => $request->subtotal,
        ];

        if ($detail_transaksi == null) {
            DetailTransaksi::create($data);
        } else {
            $data['qty'] += $detail_transaksi->qty;
            $data['subtotal'] += $detail_transaksi->subtotal;
            $detail_transaksi->update($data);
        }

        // Update total in Transaksi
        $transaksi->update(['total' => $request->subtotal + $transaksi->total]);

        return redirect()->route('admin.transaksi.create');
    }


    public function destroy(int $id)
    {
        $detail_transaksi = DetailTransaksi::find($id);

        if ($detail_transaksi) {
            $detail_transaksi->delete();
        }

        return redirect()->route('admin.transaksi.index');
    }
}
