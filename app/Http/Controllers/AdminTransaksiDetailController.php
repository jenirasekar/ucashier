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
    public function create(Request $request)
    {
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
            // mulai dari sini 
            $produk = Produk::find($produk_id);
            // ngambil stok lama
            $old_stok = $produk->stok;
            // kalkulasi stok
            $produk->update([
                'stok' => $old_stok - $request->qty
            ]);

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
                'dibayarkan' => $request->dibayarkan,
                'kembalian' => $request->dibayarkan - ($request->subtotal + $transaksi->total),
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

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
            ];
            $transaksi->update($dt);
        }

        return redirect('/transaksi/' . $transaksi_id . '/edit');
    }

    function delete()
    {
        $id = request('id');
        $td = TransaksiDetail::find($id);

        $transaksi = Transaksi::find($td->transaksi_id);
        $data = [
            'total' => $transaksi->total - $td->subtotal,
        ];
        $transaksi->update($data);

        $produk = Produk::find($td->produk_id);
        // ngambil stok lama
        $old_stok = $produk->stok;
        // kalkulasi stok
        $produk->update([
            // change it to addition
            'stok' => $old_stok + $td->qty
        ]);

        // dd($produk->refresh());

        $td->delete();
        return redirect()->back();
    }

    public function done(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        $data = [
            'pelanggan_id' => $request->pelanggan_id,
            'status' => 'belum bayar',
        ];

        $transaksi->update($data);
        return response()->json(['success' => true]);
    }

    public function pembayaran(Request $request, $id)
    {
        $transaksi =  Transaksi::find($id);
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

        $data = [
            'status' => 'selesai',
            'dibayarkan' => $request->dibayarkan,
            'kembalian' => $request->kembalian
        ];

        $transaksi->update($data);

        $timestamp = Carbon::now()->format('YmdHis');
        $filename = 'struk_' . $timestamp . '.pdf';

        $pdf = app('dompdf.wrapper')->loadView('transaksi.struk', [
            'data_struk' => $data_struk,
            'transaksi' => $transaksi
        ]);
        
        return $pdf->download($filename);

        Alert::success('Sukses', 'Transaksi berhasil!');

        return redirect('/transaksi');
    }
}
