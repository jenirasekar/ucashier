<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminTransaksiDetailController extends Controller
{
    public function store(Request $request)
    {
        $id_produk = $request->produk_id;
        $id_transaksi = $request->transaksi_id;

        $transaksi = Transaksi::find($id_transaksi);

        if ($transaksi == null) {
            $transaksi = Transaksi::where('status', 'pending')->first();
            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'total' => 0,
                'dibayarkan' => 0,
                'kembalian' => 0,
                'kasir_name' => auth()->user()->name,
                'status' => 'pending',
                'pelanggan_id' => $request->pelanggan_id
            ]);
        }

        $detail_transaksi = TransaksiDetail::where('produk_id', $id_produk)
            ->where('transaksi_id', $transaksi->id)
            ->first();

        $produk = Produk::find($id_produk);
        $reqQty = $request->qty;
        $new_stok = $produk->stok - $reqQty;
        if ($new_stok < 0) {
            $new_stok = 0;
            $reqQty = $produk->stok;
        }

        if ($detail_transaksi == null) {
            $produk = Produk::where('stok', '>', 0)->find($id_produk);

            $data = [
                'produk_id' => $id_produk,
                'produk_name' => $produk->name,
                'transaksi_id'  => $transaksi->id,
                'qty'  => $reqQty,
                'subtotal'  => $request->subtotal,
            ];
            $detail_transaksi = TransaksiDetail::create($data);
        } else {
            $data = [
                'qty'  => $detail_transaksi->qty + $reqQty,
                'subtotal'  => $request->subtotal + $detail_transaksi->subtotal,
            ];
            $detail_transaksi->update($data);
        }

        $produk = Produk::find($id_produk);
        if ($produk != null) {
            $old_stok = $produk->stok;
            $produk->update([
                'stok' => $old_stok - $reqQty
            ]);
        } else {
            throw new \Exception('Produk tidak ditemukan.');
        }

        return response()->json($detail_transaksi);
    }

    public function pendingTransaksi(Request $request)
    {
        $id_pelanggan = $request->pelanggan_id;
        $data = [
            'details' => [],
            'transaksi_id' => null,
            'total' => 0
        ];
        if ($id_pelanggan != null) {
            $transaksi = Transaksi::where('status', 'pending')
                ->where('pelanggan_id', $id_pelanggan)
                ->first();
            $details = TransaksiDetail::where('transaksi_id', $transaksi->id)->get();
            $total = TransaksiDetail::where('transaksi_id', $transaksi->id)->sum('subtotal');
        }
        $data = [
            'details' => $details,
            'transaksi_id' => $transaksi->id,
            'total' => $total
        ];

        return response()->json($data);
    }

    public function delete()
    {
        $id = request('id');
        $detail_transaksi = TransaksiDetail::find($id);

        if ($detail_transaksi) {
            $transaksi = Transaksi::find($detail_transaksi->transaksi_id);

            if ($transaksi) {
                $data = [
                    'total' => $transaksi->total - $detail_transaksi->subtotal,
                ];
                $transaksi->update($data);
            }

            $produk = Produk::find($detail_transaksi->produk_id);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                // change it to addition
                'stok' => $old_stok + $detail_transaksi->qty
            ]);

            $detail_transaksi->delete();

            return response()->json(['success' => 'Record telah dihapus']);
        } else {
            return response()->json(['error' => 'Record tidak ditemukan'], 404);
        }
    }

    public function cetakStruk(Request $request)
    {
        $id_transaksi = $request->id;
        $transaksi = Transaksi::find($id_transaksi);
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
            )->where('transaksis.id', $id_transaksi)
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
