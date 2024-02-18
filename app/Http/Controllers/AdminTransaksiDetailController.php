<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTransaksiDetailController extends Controller
{
    public function store(Request $request)
    {
        $id_produk = $request->produk_id;
        $id_transaksi = $request->transaksi_id;
        $detail_transaksi = TransaksiDetail::where('produk_id', $id_produk)
            ->where('transaksi_id', $id_transaksi)
            ->first();
        $transaksi = Transaksi::find($id_transaksi);

        if ($transaksi == null) {
            $transaksi =  Transaksi::where('status', 'pending')->first();
            // store transaksi baru yang kosong
            if ($transaksi == null) {
                $transaksi = Transaksi::create([
                    'user_id' => auth()->user()->id,
                    'total' => 0,
                    'dibayarkan' => 0,
                    'kembalian' => 0,
                    'kasir_name' => auth()->user()->name,
                    'status' => 'pending'
                ]);
            }
            // store detail transaksi dengan mengambil id transaksi di atas
            $data = [
                'produk_id' => $id_produk,
                'produk_name' => $request->produk_name,
                'transaksi_id'  => $transaksi->id,
                'qty'  => $request->qty,
                'subtotal'  => $request->subtotal,
            ];
            TransaksiDetail::create($data);

            $produk = Produk::find($id_produk);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                'stok' => $old_stok - $request->qty
            ]);
        } else {
            $data = [
                'qty'  => $detail_transaksi->qty + $request->qty,
                'subtotal'  => $request->subtotal + $detail_transaksi->subtotal,
            ];
            $detail_transaksi->update($data);

            // disini juga kalau produknya udah ada di itunya
            $produk = Produk::find($id_produk);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                'stok' => $old_stok - $request->qty
            ]);
        }

        return redirect()->route('transaksi.create');
    }

    public function delete()
    {
        $id = request('id');
        $detail_transaksi = TransaksiDetail::find($id);

        $transaksi = Transaksi::find($detail_transaksi->transaksi_id);
        $data = [
            'total' => $transaksi->total - $detail_transaksi->subtotal,
        ];
        $transaksi->update($data);

        $produk = Produk::find($detail_transaksi->produk_id);
        // ngambil stok lama
        $old_stok = $produk->stok;
        // kalkulasi stok
        $produk->update([
            // change it to addition
            'stok' => $old_stok + $detail_transaksi->qty
        ]);

        $detail_transaksi->delete();

        return response()->json(['success' => 'Record deleted successfully']);
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::find($id);
        $data_struk = DB::table('transaksis')
            ->join('transaksi_details', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->join('produks', 'produks.id', '=', 'transaksi_details.produk_id')
            ->leftJoin('pelanggans', 'pelanggans.id', '=', 'transaksis.pelanggan_id')
            ->select(
                'transaksis.id as transaksi_id',
                'transaksis.kasir_name',
                'transaksis.total',
                'transaksis.dibayarkan',
                'transaksis.kembalian',
                'transaksis.created_at',
                'transaksi_details.produk_name',
                'transaksi_details.qty',
                'transaksi_details.subtotal',
                'produks.harga as harga_produk',
                'pelanggans.nama_pelanggan',
                DB::raw('transaksi_details.qty * produks.harga as subtotal_produk')
            )->where('transaksis.id', $id)
            ->get();
        $timestamp = Carbon::now()->format('YmdHis');
        $filename = 'struk_' . $timestamp . '.pdf';

        $pdf = app('dompdf.wrapper')->loadView('transaksi.struk', [
            'data_struk' => $data_struk,
            'transaksi' => $transaksi
        ]);

        return $pdf->download($filename);
    }
}
